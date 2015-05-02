FROM nginx

MAINTAINER Jonathan Bouzekri <jonathan.bouzekri@gmail.com>

RUN \
    usermod -u 1000 www-data && \
    groupmod -g 1000 www-data && \
    apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y php5-fpm php5-intl php5-cli php5-gd php5-json php5-curl php5-mysqlnd php-apc php5-xdebug && \
    rm -rf /var/lib/apt/lists/* && \
    echo "cgi.fix_pathinfo = 0;" >> /etc/php5/fpm/php.ini && \
    sed -i 's/listen.owner = www-data/listen.owner = nginx/g' /etc/php5/fpm/pool.d/www.conf

ADD conf/nginx.conf /etc/nginx/
ADD conf/lpfactory.conf /etc/nginx/sites-enabled/

CMD service php5-fpm start && nginx
