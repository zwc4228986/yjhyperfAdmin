ARG ALPINE_VERSION

FROM hyperf/hyperf:8.1-alpine-v3.16-swoole
ARG timezone

ENV TIMEZONE=${timezone:-"Asia/Shanghai"} \
    APP_ENV=prod \
    SCAN_CACHEABLE=(true)
WORKDIR /opt/www

COPY ../api-service /opt/www

RUN composer install --no-dev -o && php bin/hyperf.php

EXPOSE 9501

ENTRYPOINT ["php", "/opt/www/bin/hyperf.php", "start"]