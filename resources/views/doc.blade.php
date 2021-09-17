<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <style>
                 body {
	font-family: Trebuchet MS, sans-serif;
	font-size: 15px;
	color: #444;
	margin-right: 24px;
}

h1	{
	font-size: 25px;
}
h2	{
	font-size: 20px;
}
h3	{
	font-size: 16px;
	font-weight: bold;
}
hr	{
	height: 1px;
	border: 0;
	color: #ddd;
	background-color: #ddd;
}

.app-desc {
  clear: both;
  margin-left: 20px;
}
.param-name {
  width: 100%;
}
.license-info {
  margin-left: 20px;
}

.license-url {
  margin-left: 20px;
}

.model {
  margin: 0 0 0px 20px;
}

.method {
  margin-left: 20px;
}

.method-notes	{
	margin: 10px 0 20px 0;
	font-size: 90%;
	color: #555;
}

pre {
  padding: 10px;
  margin-bottom: 2px;
}

.http-method {
 text-transform: uppercase;
}

pre.get {
  background-color: #0f6ab4;
}

pre.post {
  background-color: #10a54a;
}

pre.put {
  background-color: #c5862b;
}

pre.delete {
  background-color: #a41e22;
}

.huge	{
	color: #fff;
}

pre.example {
  background-color: #f3f3f3;
  padding: 10px;
  border: 1px solid #ddd;
}

code {
  white-space: pre;
}

.nickname {
  font-weight: bold;
}

.method-path {
  font-size: 1.5em;
  background-color: #0f6ab4;
}

.up {
  float:right;
}

.parameter {
  width: 500px;
}

.param {
  width: 500px;
  padding: 10px 0 0 20px;
  font-weight: bold;
}

.param-desc {
  width: 700px;
  padding: 0 0 0 20px;
  color: #777;
}

.param-type {
  font-style: italic;
}

.param-enum-header {
width: 700px;
padding: 0 0 0 60px;
color: #777;
font-weight: bold;
}

.param-enum {
width: 700px;
padding: 0 0 0 80px;
color: #777;
font-style: italic;
}

.field-label {
  padding: 0;
  margin: 0;
  clear: both;
}

.field-items	{
	padding: 0 0 15px 0;
	margin-bottom: 15px;
}

.return-type {
  clear: both;
  padding-bottom: 10px;
}

.param-header {
  font-weight: bold;
}

.method-tags {
  text-align: right;
}

.method-tag {
  background: none repeat scroll 0% 0% #24A600;
  border-radius: 3px;
  padding: 2px 10px;
  margin: 2px;
  color: #FFF;
  display: inline-block;
  text-decoration: none;
}

        </style>
    </head>
    <body class="antialiased">
        <h1>Zuri Chat To-do Plugin Endpoints</h1>
        <div class="app-desc">Zuri Chat To-do Plugin Endpoints
    (http://todo.zuri.chat)</div>
        <div class="app-desc">Version: 1.0.0</div>
        <div class="app-desc">BasePath:/api/v1</div>
      <h2>Access</h2>
    
      <h2><a name="__Methods">Methods</a></h2>
      [ Jump to <a href="#__Models">Models</a> ]
    
      <h3>Table of Contents </h3>
      <div class="method-summary"></div>
      <h4><a href="#Comments">Comments</a></h4>
      <ul>
      <li><a href="#addCommentPost"><code><span class="http-method">post</span> /add-comment</code></a></li>
      <li><a href="#findCommentBy ctaskId"><code><span class="http-method">get</span> /comments/{ctask_id}</code></a></li>
      </ul>
      <h4><a href="#SideBar">SideBar</a></h4>
      <ul>
      <li><a href="#getInfo"><code><span class="http-method">get</span> /info</code></a></li>
      <li><a href="#getSidebar"><code><span class="http-method">get</span> /sidebar</code></a></li>
      </ul>
      <h4><a href="#Tasks">Tasks</a></h4>
      <ul>
      <li><a href="#addTask"><code><span class="http-method">post</span> /add-task</code></a></li>
      <li><a href="#cancelRecurringTaskId"><code><span class="http-method">put</span> /cancel_recurringTask</code></a></li>
      <li><a href="#getArchivedTask"><code><span class="http-method">get</span> /task/archived</code></a></li>
      <li><a href="#getLatestTask"><code><span class="http-method">get</span> /getLatestTask</code></a></li>
      <li><a href="#getTaskById"><code><span class="http-method">get</span> /task/{id}</code></a></li>
      <li><a href="#getTaskById & archive"><code><span class="http-method">get</span> /task/{id}/toggleArchiveStatus</code></a></li>
      <li><a href="#getTasks"><code><span class="http-method">get</span> /task</code></a></li>
      <li><a href="#sortedTask"><code><span class="http-method">get</span> /task/sort</code></a></li>
      <li><a href="#toggleArchiveStatusWithTaskId"><code><span class="http-method">post</span> /task/{task_Id}/toggleArchiveStatus</code></a></li>
      </ul>
      <h4><a href="#ToDo">ToDo</a></h4>
      <ul>
      <li><a href="#createTdoWithFormDta"><code><span class="http-method">post</span> /todo</code></a></li>
      <li><a href="#getRooms"><code><span class="http-method">get</span> /all-rooms</code></a></li>
      <li><a href="#getToDo"><code><span class="http-method">get</span> /todo</code></a></li>
      <li><a href="#getUserInRooms"><code><span class="http-method">get</span> /users-in-room</code></a></li>
      <li><a href="#loginWithFormData"><code><span class="http-method">post</span> /auth/login</code></a></li>
      <li><a href="#updateTdoWithFormDta"><code><span class="http-method">delete</span> /todo</code></a></li>
      <li><a href="#updateTodoWithFormDta"><code><span class="http-method">put</span> /todo</code></a></li>
      </ul>
    
      <h1><a name="Comments">Comments</a></h1>
      <div class="method"><a name="addCommentPost"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="post"><code class="huge"><span class="http-method">post</span> /add-comment</code></pre></div>
        <div class="method-summary">Add comment to a task (<span class="nickname">addCommentPost</span>)</div>
        <div class="method-notes">Store Comment made by a user under a task</div>
    
    
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">task_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; task id of the current task </div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; id of the authenticated user </div><div class="param">body (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; content of the comment to be made </div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          array[<a href="#comment">comment</a>]
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="findCommentBy ctaskId"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /comments/{ctask_id}</code></pre></div>
        <div class="method-summary">get all comment of a task (<span class="nickname">findCommentBy ctaskId</span>)</div>
        <div class="method-notes">Finds comment ctask_Id</div>
    
    
    
    
    
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          array[<a href="#comment">comment</a>]
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            
        <h4 class="field-label">400</h4>
        Invalid status value
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <h1><a name="SideBar">SideBar</a></h1>
      <div class="method"><a name="getInfo"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /info</code></pre></div>
        <div class="method-summary">Plugin Information (<span class="nickname">getInfo</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
        <h3 class="field-label">Request headers</h3>
        <div class="field-items">
          <div class="param">auth (required)</div>
    
          <div class="param-desc"><span class="param-type">Header Parameter</span> &mdash; an authorization header </div>
        </div>  <!-- field-items -->
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the plugin format: int64</div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the user format: int64</div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#info">info</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#info">info</a>
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getSidebar"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /sidebar</code></pre></div>
        <div class="method-summary">Sidebar components (<span class="nickname">getSidebar</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
        <h3 class="field-label">Request headers</h3>
        <div class="field-items">
          <div class="param">auth (required)</div>
    
          <div class="param-desc"><span class="param-type">Header Parameter</span> &mdash; an authorization header </div>
        </div>  <!-- field-items -->
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the plugin format: int64</div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the user format: int64</div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#sidebar">sidebar</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#sidebar">sidebar</a>
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <h1><a name="Tasks">Tasks</a></h1>
      <div class="method"><a name="addTask"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="post"><code class="huge"><span class="http-method">post</span> /add-task</code></pre></div>
        <div class="method-summary">Create task (<span class="nickname">addTask</span>)</div>
        <div class="method-notes">Create a task</div>
    
    
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; MongoDB define the id </div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; The current user id </div><div class="param">title (optional)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; Title of the task </div><div class="param">description (optional)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; Task description </div><div class="param">status (optional)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; set status(Pending, overdue, complete) </div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#Task">Task</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        success
            <a href="#Task">Task</a>
        <h4 class="field-label">400</h4>
        Invalid input
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="cancelRecurringTaskId"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="put"><code class="huge"><span class="http-method">put</span> /cancel_recurringTask</code></pre></div>
        <div class="method-summary">set to Null (<span class="nickname">cancelRecurringTaskId</span>)</div>
        <div class="method-notes">cancel recurring task</div>
    
    
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of task to cancel recurring format: int64</div>
        </div>  <!-- field-items -->
    
    
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getArchivedTask"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /task/archived</code></pre></div>
        <div class="method-summary">get all archived tasks (<span class="nickname">getArchivedTask</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the plugin format: int64</div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          array[<a href="#todo">todo</a>]
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getLatestTask"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /getLatestTask</code></pre></div>
        <div class="method-summary">get the latest task (<span class="nickname">getLatestTask</span>)</div>
        <div class="method-notes">get the latest task in regards to time</div>
    
    
    
    
        <h3 class="field-label">Request headers</h3>
        <div class="field-items">
          <div class="param">auth (required)</div>
    
          <div class="param-desc"><span class="param-type">Header Parameter</span> &mdash; an authorization header </div>
        </div>  <!-- field-items -->
    
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#Task">Task</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        success
            <a href="#Task">Task</a>
        <h4 class="field-label">400</h4>
        Invalid ID supplied
            <a href="#"></a>
        <h4 class="field-label">404</h4>
        Task not found
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getTaskById"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /task/{id}</code></pre></div>
        <div class="method-summary">Find tasks by ID (<span class="nickname">getTaskById</span>)</div>
        <div class="method-notes">Returns a single task</div>
    
        <h3 class="field-label">Path parameters</h3>
        <div class="field-items">
          <div class="param">id (required)</div>
    
          <div class="param-desc"><span class="param-type">Path Parameter</span> &mdash; ID of task to return format: int64</div>
        </div>  <!-- field-items -->
    
    
    
    
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#Task">Task</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        success
            <a href="#Task">Task</a>
        <h4 class="field-label">400</h4>
        Invalid ID supplied
            <a href="#"></a>
        <h4 class="field-label">404</h4>
        Task not found
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getTaskById & archive"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /task/{id}/toggleArchiveStatus</code></pre></div>
        <div class="method-summary">Archive a task (<span class="nickname">getTaskById & archive</span>)</div>
        <div class="method-notes">Toggle to update the current time to archive</div>
    
        <h3 class="field-label">Path parameters</h3>
        <div class="field-items">
          <div class="param">id (required)</div>
    
          <div class="param-desc"><span class="param-type">Path Parameter</span> &mdash; Id of task to archive format: int64</div>
        </div>  <!-- field-items -->
    
    
    
    
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#Task">Task</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        success
            <a href="#Task">Task</a>
        <h4 class="field-label">400</h4>
        Invalid ID supplied
            <a href="#"></a>
        <h4 class="field-label">404</h4>
        Task not found
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getTasks"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /task</code></pre></div>
        <div class="method-summary">tasks (<span class="nickname">getTasks</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
    
    
    
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#"></a>
        <h4 class="field-label">400</h4>
        Not Found
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="sortedTask"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /task/sort</code></pre></div>
        <div class="method-summary">Returns sorted task (<span class="nickname">sortedTask</span>)</div>
        <div class="method-notes">Returns sorted task by the param</div>
    
    
    
    
    
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          
          map[String, Integer]
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="toggleArchiveStatusWithTaskId"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="post"><code class="huge"><span class="http-method">post</span> /task/{task_Id}/toggleArchiveStatus</code></pre></div>
        <div class="method-summary">toggle archive status (<span class="nickname">toggleArchiveStatusWithTaskId</span>)</div>
        <div class="method-notes"></div>
    
        <h3 class="field-label">Path parameters</h3>
        <div class="field-items">
          <div class="param">task_Id (required)</div>
    
          <div class="param-desc"><span class="param-type">Path Parameter</span> &mdash; ID of task to archive format: int64</div>
        </div>  <!-- field-items -->
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>multipart/form-data</code></li>
        </ul>
    
    
    
    
        <h3 class="field-label">Form parameters</h3>
        <div class="field-items">
          <div class="param">archived_at (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash;  </div>
        </div>  <!-- field-items -->
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#ApiResponse">ApiResponse</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#ApiResponse">ApiResponse</a>
        <h4 class="field-label">400</h4>
        Invalid input
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <h1><a name="ToDo">ToDo</a></h1>
      <div class="method"><a name="createTdoWithFormDta"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="post"><code class="huge"><span class="http-method">post</span> /todo</code></pre></div>
        <div class="method-summary">Crete a To-do with form data (<span class="nickname">createTdoWithFormDta</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>multipart/form-data</code></li>
          <li><code>application/json</code></li>
        </ul>
    
    
    
    
        <h3 class="field-label">Form parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the plugin format: int64</div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the user format: int64</div><div class="param">title (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; Title of the Todo </div><div class="param">description (optional)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; description of the Todo </div>
        </div>  <!-- field-items -->
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#todo">todo</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#todo">todo</a>
        <h4 class="field-label">400</h4>
        Invalid input
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getRooms"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /all-rooms</code></pre></div>
        <div class="method-summary">get all rooms in (<span class="nickname">getRooms</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          array[<a href="#todo">todo</a>]
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getToDo"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /todo</code></pre></div>
        <div class="method-summary">get all Todos (<span class="nickname">getToDo</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the plugin format: int64</div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the user format: int64</div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          array[<a href="#todo">todo</a>]
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="getUserInRooms"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /users-in-room</code></pre></div>
        <div class="method-summary">get all users in a rooms (<span class="nickname">getUserInRooms</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
    
    
        <h3 class="field-label">Query parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">room_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; ID of the organisation format: int64</div>
        </div>  <!-- field-items -->
    
    
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#"></a>
        <h4 class="field-label">400</h4>
        Invalid request
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="loginWithFormData"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="post"><code class="huge"><span class="http-method">post</span> /auth/login</code></pre></div>
        <div class="method-summary">Login with form data (<span class="nickname">loginWithFormData</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>multipart/form-data</code></li>
          <li><code>application/json</code></li>
        </ul>
    
    
        <h3 class="field-label">Request headers</h3>
        <div class="field-items">
          <div class="param">auth (required)</div>
    
          <div class="param-desc"><span class="param-type">Header Parameter</span> &mdash; an authorization header </div>
        </div>  <!-- field-items -->
    
    
        <h3 class="field-label">Form parameters</h3>
        <div class="field-items">
          <div class="param">email (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; email format: int64</div><div class="param">password (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; password format: int64</div>
        </div>  <!-- field-items -->
    
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#"></a>
        <h4 class="field-label">400</h4>
        Invalid input
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="updateTdoWithFormDta"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="delete"><code class="huge"><span class="http-method">delete</span> /todo</code></pre></div>
        <div class="method-summary">Update a To-do with form data (<span class="nickname">updateTdoWithFormDta</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>multipart/form-data</code></li>
          <li><code>application/json</code></li>
        </ul>
    
    
    
    
        <h3 class="field-label">Form parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the plugin format: int64</div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the user format: int64</div>
        </div>  <!-- field-items -->
    
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#"></a>
        <h4 class="field-label">405</h4>
        Not found
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
      <div class="method"><a name="updateTodoWithFormDta"/>
        <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="put"><code class="huge"><span class="http-method">put</span> /todo</code></pre></div>
        <div class="method-summary">Update a To-do with form data (<span class="nickname">updateTodoWithFormDta</span>)</div>
        <div class="method-notes"></div>
    
    
        <h3 class="field-label">Consumes</h3>
        This API call consumes the following media types via the <span class="header">Content-Type</span> request header:
        <ul>
          <li><code>multipart/form-data</code></li>
          <li><code>application/json</code></li>
        </ul>
    
    
    
    
        <h3 class="field-label">Form parameters</h3>
        <div class="field-items">
          <div class="param">organisation_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the organisation format: int64</div><div class="param">plugin_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the plugin format: int64</div><div class="param">user_id (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; ID of the user format: int64</div><div class="param">title (required)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; Title of the Todo </div><div class="param">description (optional)</div>
    
          <div class="param-desc"><span class="param-type">Form Parameter</span> &mdash; description of the Todo </div>
        </div>  <!-- field-items -->
    
        <h3 class="field-label">Return type</h3>
        <div class="return-type">
          <a href="#todo">todo</a>
          
        </div>
    
        <!--Todo: process Response Object and its headers, schema, examples -->
    
        <h3 class="field-label">Example data</h3>
        <div class="example-data-content-type">Content-Type: application/json</div>
        <pre class="example"><code>{"empty": false}</code></pre>
    
        <h3 class="field-label">Produces</h3>
        This API call produces the following media types according to the <span class="header">Accept</span> request header;
        the media type will be conveyed by the <span class="header">Content-Type</span> response header.
        <ul>
          <li><code>application/json</code></li>
        </ul>
    
        <h3 class="field-label">Responses</h3>
        <h4 class="field-label">200</h4>
        successful operation
            <a href="#todo">todo</a>
        <h4 class="field-label">400</h4>
        Invalid ID supplied
            <a href="#"></a>
        <h4 class="field-label">405</h4>
        Invalid input
            <a href="#"></a>
      </div> <!-- method -->
      <hr/>
    
      <h2><a name="__Models">Models</a></h2>
      [ Jump to <a href="#__Methods">Methods</a> ]
    
      <h3>Table of Contents</h3>
      <ol>
        <li><a href="#ApiResponse"><code>ApiResponse</code> - </a></li>
        <li><a href="#Task"><code>Task</code> - </a></li>
        <li><a href="#comment"><code>comment</code> - </a></li>
        <li><a href="#info"><code>info</code> - </a></li>
        <li><a href="#rooms"><code>rooms</code> - </a></li>
        <li><a href="#sidebar"><code>sidebar</code> - </a></li>
        <li><a href="#todo"><code>todo</code> - </a></li>
      </ol>
    
      <div class="model">
        <h3><a name="ApiResponse"><code>ApiResponse</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">status (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">code (optional)</div><div class="param-desc"><span class="param-type"><a href="#integer">Integer</a></span>  format: int32</div>
    <div class="param">type (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">message (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
        </div>  <!-- field-items -->
      </div>
      <div class="model">
        <h3><a name="Task"><code>Task</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">user_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">title (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: doggie</span></div>
    <div class="param">description (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">status (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
            <div class="param-enum-header">Enum:</div>
            <div class="param-enum">pending</div><div class="param-enum">overdue</div><div class="param-enum">complete</div>
    <div class="param">start_date (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> this is a timestampp </div>
    <div class="param">end_date (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> this is a timestampp </div>
    <div class="param">deleted_date (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> this is a timestampp </div>
    <div class="param">archive_at (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> this is a timestampp </div>
    <div class="param">recurring_data (optional)</div><div class="param-desc"><span class="param-type"><a href="#object">Object</a></span>  </div>
    <div class="param">labels (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">collaborators (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">array[String]</a></span> array of users id </div>
        </div>  <!-- field-items -->
      </div>
      <div class="model">
        <h3><a name="comment"><code>comment</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">user_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">task_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">body (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">created_at (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> this is a timestampp </div>
    <div class="param">deleted_at (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> this is a timestampp </div>
        </div>  <!-- field-items -->
      </div>
      <div class="model">
        <h3><a name="info"><code>info</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">name (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">description (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">scaffold_structure (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: Monolith</span></div>
    <div class="param">ping_url (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: https://todo.zuri.chat/api/ping</span></div>
    <div class="param">html_url (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: https://todo.zuri.chat/#/main</span></div>
    <div class="param">sidebar_url (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: https://todo.zuri.chat/api/sidebar</span></div>
        </div>  <!-- field-items -->
      </div>
      <div class="model">
        <h3><a name="rooms"><code>rooms</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">title (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: Todo 2</span></div>
    <div class="param">id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">unread (optional)</div><div class="param-desc"><span class="param-type"><a href="#object">Object</a></span>  </div>
    <div class="param">members (optional)</div><div class="param-desc"><span class="param-type"><a href="#object">Object</a></span>  </div>
    <div class="param">icon (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">action (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: open</span></div>
    <div class="param">organisation_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">owner (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">user_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
        </div>  <!-- field-items -->
      </div>
      <div class="model">
        <h3><a name="sidebar"><code>sidebar</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">name </div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: Todo Plugin</span></div>
    <div class="param">description (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">plugin_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">organisation_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">user_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">group_name (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: Tdo</span></div>
    <div class="param">show_group (optional)</div><div class="param-desc"><span class="param-type"><a href="#boolean">Boolean</a></span>  </div>
              <div class="param-desc"><span class="param-type">example: false</span></div>
    <div class="param">joined_rooms (optional)</div><div class="param-desc"><span class="param-type"><a href="#rooms">rooms</a></span>  </div>
    <div class="param">public_rooms (optional)</div><div class="param-desc"><span class="param-type"><a href="#rooms">rooms</a></span>  </div>
        </div>  <!-- field-items -->
      </div>
      <div class="model">
        <h3><a name="todo"><code>todo</code> - </a> <a class="up" href="#__Models">Up</a></h3>
        <div class='model-description'></div>
        <div class="field-items">
          <div class="param">type (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">user_id (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">title (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
    <div class="param">status (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span>  </div>
        </div>  <!-- field-items -->
      </div>
       <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
