/*
@name: MenuTree Library
@description: This library helps you to create hierarchical menus with unlimited level from an object, which contains data and is written in JSON format. You have full customization using CSS for menu nodes. Please change the function clickHandler() to catch click-event.
@author: Tran Ngoc Tuan Anh
@author's website: http://rilwis.tk
@email: rilwis@yahoo.com
*/

// Create a menu from an object written in JSON format
function menuTree(menuData) {
	this.name = menuData.name;
	this.url = (menuData.url) ? menuData.url : '' ;
	this.desc = (menuData.desc) ? menuData.desc : '';
	
	// If it's a cursive menu, create a list of submenu and add it
	if (menuData.list) {
		var list = new Array();
		for (var i = 0; i < menuData.list.length; i++) {
			list[i] = new menuTree(menuData.list[i]);
			list[i].parent = this;
		}
		this.list = new Array();
		this.addList(list);
	}
	
	// Create DOM node for menu
	this.render();
}

// Add a list of items to menu
menuTree.prototype.addList = function(list) {
	if (this.isMenu() && list.length > 0) {
		var n = this.list.length;
		for (var i = 0; i < list.length; i++, n++) {
			this.list[n] = list[i];
		}
	}
}

// Create DOM node for all menu elements
menuTree.prototype.render = function() {
	this.html = document.createElement('div');
	this.html.className = 'menuElement';
	
    // Create node for header
	this.header = document.createElement('a');
	this.header.setAttribute('href', 'javascript:void(0)');
	this.header.me = this;
	this.header.onclick = (this.isMenu()) ? showHide : clickHandler;
	this.header.appendChild(document.createTextNode(this.name));
	
    // Create node for body
	this.body = document.createElement('div');
	this.body.className = 'menuBody';
	this.body.appendChild(document.createTextNode(this.desc));
	
    // Append header and body
	this.html.appendChild(this.header);
	this.html.appendChild(this.body);
    
	// If it has submenus, create DOM node for each item recusively
    if (!this.isMenu()) {
        return;
    }
    for (var i = 0; i < this.list.length; i++) {
        this.list[i].render();
		this.body.appendChild(this.list[i].html);
    }
}

// Toogle menu on/off
function showHide() {
	var obj = this.me;
	if (!obj.isMenu()) {
		return;
	}
	if (obj.isOpened()) {
		obj.hideBody();
	} else {
		obj.showBody();
	}
}

menuTree.prototype.showBody = function() {
	this.body.style.display = '';
	this.header.className = 'menuHeaderOpened';
}

menuTree.prototype.hideBody = function() {
	this.body.style.display = 'none';
	this.header.className = 'menuHeaderClosed';
}

menuTree.prototype.isOpened = function() {
	return (this.body.style.display == '');
}

// Show menu at place indentified by containerID
// showAll is defaulted by false
menuTree.prototype.show = function(containerID, showAll) {
	this.prepare(showAll);
	var container = $(containerID);
	container.innerHTML = '';
	container.appendChild(this.html);
}

// Prepare menu before show it
// showAll is defaulted by false
menuTree.prototype.prepare = function(showAll) {
	if (!this.isMenu()) {
		this.header.className = 'itemHeader';
        return;
    }
	showAll = (typeof(showAll) == 'undefined') ? false : true;
	this.header.className = (showAll) ? 'menuHeaderOpened' : 'menuHeaderClosed';
	this.body.style.display = (showAll) ? '' : 'none';
	for (var i = 0; i < this.list.length; i++) {
		this.list[i].prepare();
	}
}

// Handler when click on menu items
function clickHandler() {
	var obj = this.me;
	// Do something here
}

menuTree.prototype.isMenu = function() {
    return (this.list) ? true : false;
}

// Reference to DOM node
function $(id) {
	return document.getElementById(id);
}