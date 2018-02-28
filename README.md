It's simple Babel Transpiler for PHP.

PHP Code:

```
$Babel = new \Babel\Transpiler\Core();
echo $Babel->execute("class REBUS {}");
```

Result: 

```
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var REBUS = function REBUS() {
  _classCallCheck(this, REBUS);
};
```
