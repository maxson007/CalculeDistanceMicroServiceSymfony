# Procédure d'installation

Steps

   * Execute at the rooting dir : `docker-compose build`
   * After completion execute : `docker-compose up -d`
   * Your database should have already been created on the mysql image
   * Execute `docker-compose exec php-fpm bash` to get into the container