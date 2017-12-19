# PHP Developer Test #

You will be creating a Black Jack card game that will consist of 2 players, the dealer and ONE player.

To initiate the game, you will ask the player how many decks they would like to play with.

The game will have 4 controls:

    - Start Game
    - Deal
    - Stand
    - Hit

   The game should continue until 60% of the cards have been dealt at the end of a hand. Upon reaching that point the game will end.
   The game will keep track of how many hands were won and lost by the player.
   
   To begin with the dealer and player will receive 2 cards each.
   The player has the option to "Hit" or "Stand". If the player's cards total is greater than 21 the player busts and play continues to the dealer.
   
   Once the player stands the dealer will play out his hand.  
   The dealer must hit at 16 or lower and must stand on 17 and above, unless it is a soft 17.
   
   If both player and dealer have the same total number or both bust the game is considered a tie and play continues with a new hand.
   
   
   ## Technology
   
   You can use any technology you find appropriate to write the game. 
   It can be backend or frontend driven.
   
   You may save states using Sessions, Cookies, Database, Cache, or any other method you prefer.
   If you prefer to work in a Framework, you can, but it is not necessary.
   
   You can load any composer packages you like.
   
   ## References
   
   You can use any major references, such as PHP.net, MySQL.com, Package documentation and so on.
   You may not copy any similar code.
   
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
  
