/**
* LifestyleLinking
*
* Start node.js LifestyleLinking Framework
*
*
* @package    LifestyleLinking Open Source Project
* @copyright  Copyright (c) 2012 James Littlejohn
* @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
* @version    $Id$
*/
var server = require("./server");
var router = require("./router");
var requestHandlers = require("./requestHandlers");
var util = require('util');

var handle = {};
handle["/"] = requestHandlers.start;
handle["/start"] = requestHandlers.start;	
handle["/css"] = requestHandlers.cssmain;	
	
server.start(router.route, handle);

