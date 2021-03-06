# mDAOnmH - Unsecure

## Done reading?

* [Let's go next to the secure version >>](../secure)

## Changes

* Use of `$_ENV` instead of hardcoded credentials.
* Fixes incorrect SQL statements

## What did not change

* The vulnerabilities are left unpatched. It will be fixed on secured version.

## Security Vulnerabilities

### 1. SQL Injection vulnerability

**Dangerous code 1:**
``` php
$sql = 'SELECT * FROM blog WHERE type="'.$_GET['filter'].'" ORDER BY created_at DESC;';
```

**Dangerous code 2:**
``` php
    $sql = '
        INSERT INTO blog SET
            title = "'.$_POST['title'].'",
            content = "'.$_POST['content'].'",
            type = "'.$_POST['type'].'",
            filename = "'.$filename.'",
            created_at = NOW()
    ';
```

**Why it is a problem?**
The variables are fresh from user  input  (`$_GET` / `$_POST`).  The  variables  must  be  at  least
sql-escaped, or the simplest solution is to make use of prepared statements.

**Notes:**
The `index.php` returns an error when we put a double quote. It gives a signal for hackers to do SQL
injection. The `create-news.php` does not return an error when we put double quote. This is a  blind
sql injection and it can be tricky for hackers. We know that there's blind sql injection because  we
got access to the source code.

### 2. Unrestricted file upload vulnerability

**Potentially dangerous code:**
``` php
    if (is_array($_FILES)) {
        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            __DIR__.'/uploads/'.$_FILES['file']['name']
        );
        $filename = $_FILES['file']['name'];
    }
```

**Why it is a problem:**
The `uploads/` folder is public, and if the webserver is not configured to not execute  PHP  on  the
said folder, the webserver is vulnerable to arbitrary code execution by simply uploading PHP scripts
on the webserver. The attacker can upload shell and take control over the server.

**Solution:**
1. (Safest) Implement a safe zone where public upload directories would not execute php files.
   Given with the nature of PHP, this is rather a problem in  the  operations  side  and  developers
   usually don't have power to play on these settings. The operations team can implement safe  zones
   where PHP files are not executed. In apache, the solution is to simply set  `php_flag engine off`
   to target  directory, in which our case is: `/var/www/html/uploads/` and serve PHP files as  text
   through `Content-type` header.
   
2. (Developer Approach) Explicitly disallow the upload of PHP if there's no explicit use case.
   * Common developer mistakes is that some developers uses mime-type to determine  file  type,  but
     the nature of mime-type is client side. The browser defines the file's mime- type  through  its
     file extension or whatever mechanism. To exploit this vulnerability, an attacker can forge  the
     request to fool the server.
   * The solution is simply disallow all files that ends in `*.php` or  any  php-executable  set  of
     files.

**PS:**
I did mention that the above code is **potentially dangerous**. Why  not  simply  dangerous?  It  is
because it is possible to prevent PHP execution by configuring your webserver not to execute PHP  on
specific public directory. Developers don't usually play  with  this,  and  this  is  an  operations
problem. The common approach for vast majority of developers is to simply disallow uploading of  PHP
script.

### 3. Persistent XSS

**Dangerous code:**
``` html+php
<img class="card-img-top" src="uploads/<?=$blog['filename']?>" alt="">
<h4 class="card-title"><?=$blog['title']?></h4>
```

It is persistent XSS because the data comes from the database. And it is vulnerable to  XSS  because
the variable is not html-safe.

**Solution:**
Wrap it with `htmlspecialchars`.

``` html+php
            <?php foreach ($blogs as $blog) { ?>
            <div class="col-lg-3 col-md-6 mb-4 mt-2">
                <div class="card h-100">
                    <img class="card-img-top" src="uploads/<?=htmlspecialchars($blog['filename'])?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?=htmlspecialchars($blog['title'])?></h4>
                        <p class="card-text" style="text-overflow:ellipsis; max-height: 200px; overflow:hidden"><?=$blog['content']?></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">Find Out More!</a>
                    </div>
                </div>
            </div>
            <?php } ?>
```

## Other Issues

Other issues are to be further emphasized  here  on  my  [secure version](../secure)  of  this  app.
The [secure version](../secure) is just a minimal refactor eliminating all security vulnerabilities,
but keeps the code structure as much as possible.
