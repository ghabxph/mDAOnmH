# mDAOnmH - Secure

## Done reading?

* [Let's go next to better version >>](../better)
* [<< Go back to unsecure](../unsecure)

## Changes

* General changes
  * Added check if connecton is valid or not.
  * Using prepared statement to prevent SQL Injection
* `index.php`
  * Using htmlspecialchars to prevent XSS
* `create-news.php`
  * Uploads folder is placed in a safe location where PHP scripts will not execute.
    * `/var/www/uploads`
    * This new folder is being served by caddy web server separately.
  * Hashes the uploaded file and use it as the file's file name.
  * Restricts the file extension to images only specified here in this document.
    * https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types

## Issues

### 1. (CODE SMELL) Separation of concern.

It is ideal to separate the logic from the front end. Keeping this practice is never going
to be sustainable in the long run if the project goes. It is possible to keep thing lean
even we do the procedural approach by applying "Clean Architechture".

### 2. (CODE SMELL) Redundant code.

Usage of mysqli_connect is redundant.

### 3. (UX) Lacks validation in create article.

At least when you're creating new article, you would like to at least make sure that  your
article has title and content.

### 4. (UX) No label in file upload in create article.

What file can I upload? I just figured out that  I  only  need  to  upload  image  in  the
"choose file" field by looking into index.php's source code. Thus going  back  to  #1,  we
must implement validation for this.

**Point #1.** Put label on "choose file" field. Make it clear that  you  can  only  upload
              image.
**Point #2.** Apply validation for file upload (front)
**Point #3.** Most importantly, apply validation on the backend. Since it's clear that  we
              need to upload an image file, do a whitelist upload.

### 5. (UX/PERF) Inefficient rendering of content in `index.php` or home page

In the server side, the content must be trimmed to specific number of string  so  that  we
only display enough characters in our page. In return, the number  of  bytes  we  received
from index.php would be minimal.

## Desired Architechture (Keeping the endpoints)

It doesn't mean that clean architechture is limited to OOP. This  is  my  initial  desired
clean design that I'm going to work on for the next iteration of this application.

![](../../assets/desired-architechture-1.jpg)

The  file  upload  storage   has  already   been   implemented   in   this   stage.   This
[Caddyfile](caddy/Caddyfile) allows it to happen.

The rest such as `entity`,`controller`, `view`, `gateway` are to  be  implemented  in  the
next iteration of this application.
