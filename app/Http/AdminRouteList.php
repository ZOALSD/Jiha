<?php
/*
* To implement in admingroups permissions
* to remove CRUD from Validation remove route name
* CRUD Role permission (create,read,update,delete)
* [it v 1.6.40]
*/
return [
	"generals"=>["read","update"],
	"orderviews"=>["create","read","update"],
	"customers"=>["read"],
	"colors"=>["create","read","update","delete"],
	"services"=>["read"],
	"contacts"=>["read"],
	"productscontrollrt"=>["create","read","update","delete"],
	"sizes"=>["create","read","update","delete"],
	"favorites"=>["read"],
	"locations"=>["create","read","update","delete"],
	"videos"=>["create","read","update","delete"],
	"images"=>["create","read","update","delete"],
	"categories"=>["create","read","update","delete"],
	"image"=>["create","read","update","delete"],
	"admins"=>["create","read","update","delete"],
	"admingroups"=>["create","read","update","delete"],
];