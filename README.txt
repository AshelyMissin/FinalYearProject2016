--- READ ME ---
In order to test this software, you must first create a DB and then import the test data which is located on the file called "m026446e.sql" as well as making sure that when testing it, you are to either change the username and password on EACH of the files for connecting to the DB, as when I initially made this I was using a test server with 'root' and '' as the username and password respectively. Or, change the username and password of your DB to 'root' and '' respectively.

Looking back at the whole project though, a key improvement would have been to just have 1 file for the DB information and then adding an 'include' line on each page, dragging that information across, rather than putting it on each file.
