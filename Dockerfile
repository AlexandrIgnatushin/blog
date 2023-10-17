FROM mattrayner/lamp:latest-2004-php8

COPY apache2.conf /etc/apache2/apache2.conf

CMD ["/run.sh"]
