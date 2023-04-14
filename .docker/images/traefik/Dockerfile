FROM traefik:v2.9.6

HEALTHCHECK --interval=30s --timeout=30s \
  CMD traefik healthcheck --ping || exit 1