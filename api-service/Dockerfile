ARG ALPINE_VERSION

FROM hyperf/hyperf:8.1-alpine-v3.16-swoole
ARG timezone

ENV TIMEZONE=${timezone:-"Asia/Shanghai"} \
    APP_ENV=prod \
    SCAN_CACHEABLE=(true)


COPY ./api-service /opt/www/api-service
COPY ./plugin /opt/www/plugin


WORKDIR /opt/www/api-service
RUN composer install --no-dev -o && php bin/hyperf.php

EXPOSE 9501
EXPOSE 9502

ENTRYPOINT ["php", "/opt/www/api-service/bin/hyperf.php", "start"]