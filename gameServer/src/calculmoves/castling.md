


adding this  :

 castlingRights: {
    white: { kingSide: true, queenSide: true },
    black: { kingSide: true, queenSide: true }
  },

  to the gamestate to check if the user has the right to caslte 

  if the king moved we set  false in  both { kingSide: true, queenSide: true }

  if the rook moved we set  false in  based on his side  

  if the king has the right to caslte we add the move the potiental move of the king and then check if the added squares are attecked
   
