
How Routing works. 
============================================

OK So when a  band is tapped the server logic goes as follows. 

/b/@tagid will route to the Controller \Rystband\Site\Controllers\Tags->Routing

Routing loads the tag from the database, and than checks to see if it is attached to an event, if so it checks for a theme, if there is a theme attached it loads that load overriding the default RystBandTheme.

it than passes the tag to the Type Routing which  routes the tag to the Type Controller if it is special for example it routes to tags Controller/Action and if for now by default it will route to the Event System. 

Event Routing
=============================================
Once a Tag has been passed to the Event Router. 

\Rystband\Site\Controllers\Tags\Event->action($tag);

It looks for the current logged in session of tapper, if it is an Employee logged in with a role, if none it goes to the tapper  routing. 
