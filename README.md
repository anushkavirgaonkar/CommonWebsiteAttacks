# CommonWebsiteAttacks
Demonstration of common website attacks such as the SQL injection attack, cross-site scripting attack and the local file inclusion attack, along with their preventive measures.

# SQL Injection

## Demonstration
![Image alt text](/path/to/img.jpg)
This is the front-end login page. The username and password are sent as POST parameters $uname and $pass respectively. Then the SQL query 

````
  $sql = "SELECT username FROM sqli_admin WHERE username = '$uname' and password = '$pass'";
````

is used to check if the credentials entered by the user are valid or not. The attacker, however, does not have valid credentials. Therefore, the attacker manipulates the query by injecting this code: ' or '1' = '1 in the username and password field. Thus, the POST parameters become: $uname = ' or '1' = '1 and $pass = ' or '1' = '1. The SQL query becomes:
````
$sql = "SELECT username FROM sqli_admin WHERE username = ' ' or '1' = '1' and password = ' ' or '1' = '1' ";
````
We can observe that the input string has become a part of the SQL query. The SQL query is not only valid, but it also is modified in such a manner that it returns ALL rows from the "sqli_admin" table since OR 1=1 is always TRUE. 

![Image alt text](/path/to/img.jpg)


## Prevention
Prevention of SQL injection attacks can be done using parameterized statements. Programming languages talk to SQL databases using database drivers. A driver allows an application to construct and run SQL statements against a database, extracting and manipulating data as needed. Parameterized statements make sure that the parameters (i.e. inputs) passed into SQL statements are treated in a safe manner. Therefore, the inputs cannot modify the meaning of the query, thereby preventing the attack.


# Cross-site Scripting

## Demonstration
In this demonstration of the XSS attacker, the malicious javascript is going to store all of the keystrokes made by the user. The malicious javascript then sends the payload consisting of the keystrokes to a PHP server controlled by the attacker. The PHP script that runs on this server writes all the payload (keystrokes) received from the malicious javascript to a log file. But, for this to work, the malicious javascript file needs to included in the victim’s browser. If we take a closer look at the website, we can see that comments made by users are shown on the login page. These comments can be added through the feedback form, after logging in.

![Image alt text](/path/to/img.jpg)

After logging into the application, the attacker fills the feedback form. In the comments input field, the malicious javascript file is included. 
![Image alt text](/path/to/img.jpg)
When the feedback form is submitted, the comment (including the javascript file) is stored in the database. Now, when a victim user opens the web application, the attacker’s comment is seen on the login page. However, the script tags cannot be seen in the comment, because they are now a part of the website.

![Image alt text](/path/to/img.jpg)

By viewing the source code, we can see that the malicious javascript code is now included in the webpage.


![Image alt text](/path/to/img.jpg)
Now, when the victim visits this website, which has the malicious javascript included in it, all of his/her keystrokes would be logged due to the javascript program. Therefore, when the victim user enters his/her credentials, they would be sent to the PHP server controlled by the attacker and the PHP server would write it in the log file.


![Image alt text](/path/to/img.jpg)
![Image alt text](/path/to/img.jpg)
![Image alt text](/path/to/img.jpg)

## Prevention
![Image alt text](/path/to/img.jpg)
XSS can be prevented by sanitizing the input. It is done using the built-in htmlentities() function that PHP offers. The security of this construction depends on the presence of the ENT_QUOTES and ENT_HTML5 flags which help to escape the HTML attribute values and therefore, it prevents any HTML characters from displaying on the web page.


# Local File Inclusion
 
## Demonstration
LFI vulnerabilities are easy to identify and exploit. Any script that includes a file from a web server is a good candidate for further LFI testing.

![Image alt text](/path/to/img.jpg)
![Image alt text](/path/to/img.jpg)


The webpage searches and displays the product information requested by the user. By observing the URL: “/path/service.php?id=1”, it is understood that the value of the “id” parameter is the file that would be included on the website. We can exploit this and perform directory traversal to display other files on the webserver.

![Image alt text](/path/to/img.jpg)
Similarly, we can view the /etc/password file on a Linux based server.


## Prevention
LFI can be prevented very effectively by maintaining a whitelist of web pages that can be included. Any webpage which is not present in the white list, would not be included in the website.


![Image alt text](/path/to/img.jpg)

