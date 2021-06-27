# Gramble framework

### Requirements

The `composer` manager is needed to deploy on development environment, so download
it on its source website.\
Once you've installed it run `composer update` from within your working directory and
you'll see a vendor folder which contains data referred to composer for handling packages.

### Instructions

To launch the web server run `php -S localhost:8080 -t public/` on your local terminal.\
Then open your favorite browser and type the address on the url field.

#### Error logs

If you want to enable error log in browser run `./gramble enable-error-logs`

### TODO List
- [ ] Add feature for enabling error logs
- [ ] Add `render_view` feature
- [ ] Add feature for adding new route from terminal/console input