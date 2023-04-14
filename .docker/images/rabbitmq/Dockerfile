FROM rabbitmq:3.10.10-management-alpine

HEALTHCHECK --interval=30s --timeout=30s \
  CMD rabbitmq-diagnostics check_port_connectivity || exit 1