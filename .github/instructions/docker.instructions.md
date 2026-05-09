---
applyTo:
  - docker-compose.yml
  - docker/**
  - .env.example
  - src/.env.example
  - bootstrap.sh
  - Makefile
  - .github/workflows/**
---

# Instrucciones Docker, entorno y CI

- La aplicacion Laravel vive en `src/`.
- El contenedor principal es `app`; no asumir servicio `node` separado.
- Nginx sirve `src/public` a traves del servicio `web`.
- Variables operativas de Laravel viven en `src/.env`.
- Workflows de GitHub deben vivir en `.github/workflows/**` en la raiz y ejecutar comandos con `working-directory: src`.
- No introducir secretos reales en archivos versionados.
- Mantener comandos de README, Makefile y `docs/procedimientos.md` alineados.

## Validacion de cierre

- Revisar estructura con `docker compose config` si se toca Compose.
- Verificar que comandos documentados usen servicios existentes.
