# Authentication Integration (Backend + Frontend)

## 1) Backend Authentication Analysis

### Endpoints discovered in Laravel (`backend-pharmc/routes/api.php`)
- `POST /auth/login`
- `POST /auth/logout` (protected)
- `GET /auth/me` (protected)

With frontend base URL `VITE_API_BASE_URL=http://localhost:8000/api`, the effective login URL is:
- `POST http://localhost:8000/api/auth/login`

### Authentication mechanism
The backend is **custom token authentication** (not Sanctum, Passport, or JWT):
- Token is generated in `AuthController::issueToken()` and stored hashed in `api_sessions`.
- Middleware `api.token` validates `Authorization: Bearer <token>` against `api_sessions.token_hash`, revocation, and expiry.
- Default expiry: **30 days** (`expires_at = now()->addDays(30)`).

### Login request contract (`AuthController@login`)
Accepted payload:
- `identifier` (nullable, string, max 255) OR
- `email` (nullable, email, max 255) OR
- `phone` (nullable, string, max 30)
- `password` (required, string)
- `token_name` (nullable, string, max 120)

Frontend sends `identifier + password + token_name`.

### Login response contract
Success `200`:
```json
{
  "token": "<plain_token>",
  "user": {
    "id": 1,
    "name": "...",
    "email": "...",
    "phone": "...",
    "role": "manager|pharmacist|patient|general",
    "pharmacies": []
  }
}
```

Validation/auth failure (`422` validation exception):
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "identifier": ["Email or phone is required."]
  }
}
```
or
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "identifier": ["Invalid credentials."]
  }
}
```

Unauthorized protected calls (`401`):
```json
{ "message": "Unauthorized" }
```

Forbidden role-protected calls (`403`):
```json
{ "message": "Forbidden" }
```

## 2) Frontend Implementation Summary

### Login view
- File: `src/views/Login.vue`
- Features:
  - Identifier + password inputs
  - Frontend validation (required + email format when identifier contains `@`)
  - Loading state while submitting
  - Backend error display (field-level + form-level)

### API client module
- File: `src/services/api.js`
- Features:
  - Axios instance with configurable `baseURL` from `VITE_API_BASE_URL`
  - Request interceptor attaches `Authorization: Bearer <token>` automatically
  - Response interceptor triggers unauthorized handler on `401`

### Auth service module
- File: `src/services/authService.js`
- Features:
  - `login`, `logout`, `fetchMe`, `restoreSession`, `isAuthenticated`
  - Role helper: `getRouteByRole`, `hasRole`
  - Centralized backend error mapping: `mapAuthError`
  - Session restore on app navigation

### Token storage module
- File: `src/services/authStorage.js`
- Storage keys configurable via env:
  - `VITE_AUTH_TOKEN_KEY`
  - `VITE_AUTH_USER_KEY`

### Route guards
- File: `src/router/index.js`
- Behavior:
  - `requiresAuth` routes redirect unauthenticated users to `/login`
  - `guestOnly` route (`/login`) redirects authenticated users to role-based home
  - Role-based checks with route meta `roles`

## 3) Request/Response Cycle (Textual Flow Diagram)

```text
[Login.vue submit]
   -> POST /auth/login { identifier, password, token_name }
      -> [200 OK]
         -> store token + user (sessionStorage)
         -> router redirect to role home
      -> [422 Validation/Auth Error]
         -> map errors -> show field/form messages

[Navigation to protected route]
   -> router.beforeEach()
      -> authService.restoreSession()
         -> if token exists: GET /auth/me with Bearer token
             -> [200] keep session
             -> [401] clear session and redirect /login

[Authenticated API calls]
   -> axios request interceptor injects Bearer token
   -> backend api.token middleware validates token/expiry/revocation
```

## 4) Validation Strategy

### Frontend validation
- Identifier required
- Password required
- If identifier looks like email (`contains @`), validate email format

### Backend validation (source of truth)
- `password` required
- identifier/email/phone combination rules from Laravel `validate()`
- Credentials validated with password hash check

Frontend always surfaces backend validation output for final correctness.

## 5) Token Lifecycle

1. Created at login in backend (`ApiSession` record + plain token response).
2. Stored in frontend sessionStorage with minimal user object.
3. Attached automatically on every request via Axios interceptor.
4. Validated by `api.token` middleware (hash match, not revoked, not expired).
5. Revoked on `/auth/logout` (or becomes invalid at expiry), then frontend clears local session.

## 6) Configuration and CORS

### Frontend env
- `VITE_API_BASE_URL` (required per environment)
- `VITE_AUTH_TOKEN_KEY` (optional)
- `VITE_AUTH_USER_KEY` (optional)

### Backend CORS
Backend already allows API CORS on `api/*` with:
- `allowed_origins: ['*']`
- `supports_credentials: false`

This matches Bearer-token-based auth (no cookie credentials needed).
