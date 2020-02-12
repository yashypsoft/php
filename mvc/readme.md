For advanced routing

multile request for diff. route 

^ = thes tart of these string
$ = end of the string



* = zero or more occurance

_ = one ore more occurance
. =any single charcter replace it
.*  = any number of any character
\ -match metacharacter by escaping them

pattern are case sensitive .
adding the "i"modifier after the regex makes it case insesitive.


##4
Write even more powerful regex

[] =match  one of any of the character in the brackets 
eg.[abc] will match a,b or c and nothing else:


[ - ] = specifify a renge of character inside a character set rg. [0-9]
wil mstch a single digit beetween 0 and 9

[^ ] = negate \ neglate  the character class match any one character expext for the character specofied,including ranges:

##5
Extract parts of string usingg regex caoturengroups

[regex matching ]
preg_match($reg_ex,$string,$matches)

( ) = capture group inside the paranthesis(the subpattern) ot acapture group.

$reg_ex               $string             $match
/([a-zA-Z]+)(\d+)/    Jan 1990            [0=>"Jan 1990"
                                           1=> "Jan"
                                           2=>"1992"]

additional thing we dothem a capture name

(?<name>)regex  = give the capture a name

$reg_ex                                $string             $match
/(?<month>[a-zA-Z]+)(?<year>\d+)/       Jan 1990           [....
                                                            "month"=> "Jan"
                                                            "year"=>"1992"]
##6
Get the controller and qaction from a url with a fixed structure

matching routes with patterns

Instead of a simple comparison 
if($url == $route){}

match to a pattern
if(preg_match($reg_ex),$url)

temp.com/controller/action

temp.com/posts/index
temp.com/posts/new
temp.com/blog/index
temp.com/products/list

temp.com/controller/action

/^(?P<controller>[a-z-]+)\/(?P<action>[a-z]+)$/

preg_match($regexp,"posts/index",$matches)

    $matches
    ["controller" => "posts",
    "action" =>  "index"
    ]

##7 
Replace parts of  string using regex

preg_replace($regex,$replacement,$string)

$reg_exp   $replacement   $string



##8
24..Dispatch

how dispatch work
1.if match with url
$controller = data from param['controller]
$controller = convert to study caps

2. class exists($controller)
    create object of controller

    $action = param['avtion]
    $action = convert to camalcase

if(is_callable([$controller_obj,$action]))
    $controll_ob -> $action();
    else
        echo "Method $action not found:
else{
    controller not found

}
else{

}



//##25
better way to organize your code with namespace


##30 
The __call magic method  ow to call inassible method in class

public method  are accessible outside of class
protexted method are nnot available from outside the class

ex.
class Product
{
  public function save(){}
  privae function  modify(){}
}       

$product  = new Product();
$product->save();
$product->mmodify();

private method gets error

__call in php magic method
called whwnever a non-existent or non public method is called on an object

class Product
{
  public function __call($name,$arguments){}
  privae function  modify(){}
}

$product  = new Product();
$product->mmodify();

because method is private so __call is called

we can call private method using call_user_fun_array([$this,$method],$args);

ex
class Product
{
  public function __call($method,$arguments){
      call_user_func_array([$this,$method],$args);
  }
  //__call args are $method = modify and $argumenths= [123,"a"]
  privae function  modify(){}
}

$product->modify(123,"a")


##31
action filters  :call a method before and fter every ction in  controller

How to execute some code  before or after every action??

for example:

checking user is logged in or not
writing a message to a log
setting the language etc

__call is executed for a non existent or non public method call
by executing __call first we can run code before and after a method

class Posts{
    public function __call($name,$args)
    {
        //Run code before
        call_user_func_array([$this,$name],$args);
        //run code after
    }
}


1. Make the action methods private
2. add a sufix to the method name 

\\2 
class Posts{
    public funtion __call($name,$args){
        //run code before
        call_user_func_array([$this,"$nameAction"],$args); 
        //run code after 
    }
    public function indexAction(){

    }
} 

##3
Organize controller in subdirectories 

##34
View intro
view are what the user sees on screen
they present data to the user

##35
render metod in view core

##36
htmlspecialchars();   --- for convert special character to html

##37
Pass data from the controller to the view

