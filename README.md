Steps to run project
========================

1. Goto project directory

2. Download project dependencies <br> 
composer install

3. Run Apache Server <br> 
 php bin/console server:run
 
4. Call url <br>
http://localhost:8000/products  

5. Call Test cases <br>
php bin/phpunit
 
 
Notes
=====

1. I do not take the file using html form as per instruction. File names are hard coded in controller.
2. Data mapping is not uniform because symfony serializer does not provide multiple name mapping in model class. I have 
applied both manual and automatic techniques for mapping data in model.
3. I write multiple test cases.
4. I use Factory design pattern for this implementation. 
  

