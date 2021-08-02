FROM lissonpsantos2/php:7.4.11-minimum-laravel

ARG SLACK_URL

ENV APP_ENV production
ENV LOG_CHANNEL stack
ENV LOG_SLACK_WEBHOOK_URL $SLACK_URL
ENV APP_DEBUG false
ENV TZ America/Bahia
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

EXPOSE 80

WORKDIR /app
COPY . /app
RUN cp .env.example .env

COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/cron-job /etc/cron.d/cron-job
RUN chmod 0644 /etc/cron.d/cron-job
RUN crontab /etc/cron.d/cron-job

RUN php artisan key:generate
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data ./storage
RUN usermod -aG www-data root
RUN chmod g+w /app/storage
RUN a2enmod rewrite

CMD /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf & cron & apache2-foreground
