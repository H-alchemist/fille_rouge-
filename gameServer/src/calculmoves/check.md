## to implement the check / checkmate  / stalemate 







function we gonna need are :

findKingPosition()

getPieacePotentialMoves()  to get all the possible moves for a piece regadless of check and pin stuations 


and checkbetween()  to check if there is no defender between the king and the attacker





## checkmate


ok check if the king in checkmate  :


need to be in check ,

kinghasnoValidMoves ,

noOtherPiecesCan ( stand in the way or capture the attacker )




## stalemate 



ok check if the king in stalemate  :


not in check ,

kinghasnoValidMoves ,

no other pieace has valid move 





function we need :


  we need to check if a square is attacked by a piece  > isSquareAttacked()


  getLegalMoves() for a pieace







