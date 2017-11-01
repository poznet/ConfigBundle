# ConfigBundle
Simple Configuration handling   in SF 

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7aeeb69c-7452-44aa-adca-f386dee64193/big.png)](https://insight.sensiolabs.com/projects/7aeeb69c-7452-44aa-adca-f386dee64193)

## Idea  

Idea is really simple, doing anything  with symfony you need very often to save some config data.
Parameters.yml are good , but it's  problematic to save item to them from application level.
 
So based on WB/Presta experience i creates  simple service to store some data.
 
Data are serializaed and stored in db.

## Instalation 
Use `composer require poznet/ConfigBundle`


## Usage
Simple:

`$this->get('configuration')->save('foo','bar');`   - saves 'bar' string  in configuration  with key 'foo'.Also you can save any type od data (variables, classes  etc. )

To retrive data use : 
`$x=$this->get('configuration')->get('foo');`
 

### Licence 
This Bundle is licensed under the MIT License. Feel free to contribute.
