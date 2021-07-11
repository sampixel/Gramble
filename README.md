# Gramble framework

### Requierements

In order to use gramble you need to install it.

### Instructions

To launch the web server run `php -S localhost:8080 -t public/` on your local terminal.\
Then open your favorite browser and type the address on the url field.

#### Error logs

If you want to enable error log in browser run `./gramble enable-error-logs`

### TODO List
- [ ] Add feature for enabling error logs
- [x] Add `render_view` feature
- [ ] Add feature for adding new route from terminal/console input
- [ ] Create a command that enable/disable error logs
- [ ] Create a make file to enable gramble package locally/globally
- [ ] Add a template that can be extended from other views
- [ ] Customize the 404 status view
- [ ] Add "clear logs" command that deletes phpd.log file
- [ ] Remove all html/php files from src folder (this should be a skeleton project)
- [x] url need to fix when the path end with "/" (page is loaded correctly but can't load style and script files)
- [ ] Find a way to pass an array of data inside the php view