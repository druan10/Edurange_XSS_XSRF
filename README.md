# edurange_wvs

WIP scenario for Edurange aimed at demonstrating XSS, content spoofing, XSRF, and other common web vulnerabilities

##CURRENT TODO LIST

~~Add server side password complexity requirement validation
users can still submit signup through post request and server will not validate password requirements~~

~~Implement search function to find other users of the site if logged in
  Disable search function in navigation bar if not logged in~~
  
~~remove echo functions from php
  Stylistic purposes~~

Finish user_profile.php page
  Should include
    profile picture nicely formatted (having css issues)
    list of recent posts
    button to show more posts
    
~~Implement insecure html sanitation (Wip)
  basic html sanitation for students to try and break when they use the site as training
  Should enforce the need for proper html sanitation (probably shouldn't do it yourself)
  (update) Works at a basic level using case insensitive string replace functions. Has some weird side effects and can be easily broken using malformed tags and attributes.~~
  
Finish user_home.php page
  Show other randomly selected users and (maybe) Their latest post.
  Want a link to their profile (user_profile.php modified with GET request parameter)
  
Implement Get Request (content spoofing) vulnerability in search function
  GET variables are used to retrieve username on user_profile.php page.
  Should be able to include quotation marks to break out of regular GET request and insert reflected XSS
  
~~Create demo malicious profile
  create a sample malicious code on that page that does something like writes a post as the user being exploited
  "Samy" worm is a good example~~
  
  User "notahacker" has this script on their profile @ ip/user_profile?username=notahacker

Create second version that enables the user's browser xss filter header?
  header("X-XSS-Protection: 1"); //php command to enable this, this is the default
  Can be used for a more difficult version of this scenario, for more experienced students

~~Fix lack of username & password sanitation
  users can enter any characters for their username and anything for their password as long as it fulfills the requirements
  Adding a ; to the username would break the password verification system as my code explodes lines on that character~~

~~Group functions in common.php file by their role, (signup related, gathering data, etc)~~

~~Limit usernames to numbers, letters and underscores
  Now checked for using javascript, still need to implement server side validation.~~

Create Scoring System
  Task based scoring?
    Use X-Forwarding
    Exploit XSS
    Gain Admin Status (Server should not trust user content, Look at Gruyere)
  
