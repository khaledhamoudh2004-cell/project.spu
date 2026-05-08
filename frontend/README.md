# PharmaLink Frontend

Vue + Vite frontend integrated with Laravel backend authentication.

## Run

```bash
npm install
npm run dev
```

## Environment

Copy `.env.example` to `.env` and adjust:

```env
VITE_API_BASE_URL=http://localhost:8000/api
VITE_AUTH_TOKEN_KEY=pharmalink_auth_token
VITE_AUTH_USER_KEY=pharmalink_auth_user
```

## Routes

- `/login` (guest only)
- `/manager-overview` (protected, role: manager)
- `/pharmacist-inventory` (protected, role: pharmacist/manager)
- `/patient-search` (protected)

## Auth Modules

- API client: `src/services/api.js`
- Auth service: `src/services/authService.js`
- Token storage: `src/services/authStorage.js`
- Route guards: `src/router/index.js`
- Login page: `src/views/Login.vue`

## Auth Documentation

Detailed integration notes and backend contract:
- `docs/AUTHENTICATION.md`