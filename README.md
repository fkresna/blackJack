# PHP Developer Test #

You will be creating a Black Jack card game that will consist of 2 players, the dealer and ONE player.

To initiate the game, you will ask th player how many decks they would like to play with.

The game will have 4 controls:

    - Start Game
    - Deal
    - Stand
    - Hit

   The game should continue until 60% of the cards have been used. Upon reaching that point the game will end.
   The game will keep track of how many hands were won and loss by the player.
   
   To begin with the dealer and player will receive 2 cards.
   The player has the option to "Hit" or "Stand".
   
   Once the player stands the dealer will play out his hand.  
   The dealer must hit at 16 or lower. And must stand on 17 and above.
   
   
   ## Technology
   
   You can use any technology you find appropriate to write the game. 
   It can be backend or front end driven.
   
   You may save states using Sessions, Cookies, Database or Cache.
   If you prefer to work in a Framework, you can, but not necessary.
   
   You can load any composer packages you like.
   
   ## References
   You can use any major references, such as PHP.net, MySQL.com, Package documentation and so on.
   You may not copy any similar public code.
   
   ## Infrastructure
   
   Nginx Web Server
   PHP version is 7.1
   MySQL Version is 5.7
   Redis Server
   
   The IP address of the server is 192.168.56.56.
   
   The server is a Vagrant virtual machine that you can ssh into using the command:
   ```
   vagrant ssh
   Username: vagrant
   Password: vagrant
   ```
  Logs are located in the standard /var/log
  
