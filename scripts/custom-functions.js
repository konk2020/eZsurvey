// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: comparefunction 
// File: custom-function.js
// Other files called: none
// includes: none

function comparepwd()
{
var empt = document.forms["form1"]["pwd"].value;
var empt1 = document.forms["form1"]["pwd-repeat"].value;

if (empt != empt1)
{
alert("Passwords do not match!!");
return false;
}
}