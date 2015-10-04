Small website project based on [SB Admin 2](http://startbootstrap.com/template-overviews/sb-admin-2/), to analyze and display the status of the SAMADhi database (and more).
Main functionalities are: 
  - dashboard with general statistics and check of the online services
  - report page for datasets, samples, results
  - result browser (display content of registered ROOT files)

Some of the functionalities are implemented via python CGIs, but most of it is done in javascript.
Statistics about SAMADhi are accessed via json summaries produced by the analysis script found in the SAMADhi project. This script should run on the server via a cron. 

The assumption is made that the result files will be accessible from the webserver.

[SB Admin 2](http://startbootstrap.com/template-overviews/sb-admin-2/) is an open source, admin dashboard template for [Bootstrap](http://getbootstrap.com/) created by [Start Bootstrap](http://startbootstrap.com/).

