# Edurange_XSS_XSRF

WIP scenario for Edurange aimed at demonstrating XSS, content spoofing, XSRF, and other common web vulnerabilities

##CURRENT TODO LIST

Add server side password complexity requirement validation
  users can still submit signup through post request and server will not validate password requirements

Implement search function to find other users of the site if logged in
  Disable search function in navigation bar if not logged in
  
remove echo functions from php
  Stylistic purposes

Finish user_profile.php page
  Should include
    profile picture nicely formatted (having css issues)
    list of recent posts
    button to show more posts
    
Implement insecure html sanitation
  basic html sanitation for students to try and break when they use the site as training
  Should enforce the need for proper html sanitation (probably shouldn't do it yourself)
  
Implement Get Request (content spoofing) vulnerability in search function
  GET variables are used to retrieve username on user_profile.php page.
  Should be able to include quotation marks to break out of regular GET request and insert reflected XSS
  
Create demo malicious profile
  create a sample malicious code on that page that does something like writes a post as the user being exploited
  "Samy" worm is a good example

Create second version that enables the user's browser xss filter header.
  header("X-XSS-Protection: 1"); //php command to enable this, this is the default
  Can be used for a more difficult version of this scenario, for more experienced students
