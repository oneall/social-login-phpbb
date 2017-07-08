
$("input#cur_password").attr({
	disabled: 1, 
	value: "" + (1000000 + Math.floor ( Math.random ( ) * 9999999 + 1))
});

