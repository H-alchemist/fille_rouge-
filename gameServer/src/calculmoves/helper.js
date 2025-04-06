
// return if the pieace and the king in the same line to check if the piece pinned

function isPieceAligned(piecePosition, kingPosition) {
    let x = kingPosition[0] - piecePosition[0];
    let y = kingPosition[1] - piecePosition[1];

    if (x === 0) {
        return [0, 1 * Math.sign(y)];
    } else if (y === 0) {
        return [Math.sign(x), 0];
    } else if (Math.abs(x) === Math.abs(y)) {
        return [Math.abs(x),Math.abs(y)];
    } else {
        return false;
    }
}

// the squares between the king and pieace  is empty

function isClearBetween(pos1, pos2, board) {
    let [x1, y1] = pos1;
    
    let [x2, y2] = pos2;

   
    let dx = Math.sign(x2 - x1);

    let dy = Math.sign(y2 - y1);

   
    let x = x1 + dx;
    let y = y1 + dy;


    while (x !== x2 || y !== y2) {
        
        if (x <= 0 || x > 8 || y <= 0 || y > 8) {
            return false; 
        }

       
        if (board[y][x] !== 0) {
            return false;
        }

        x += dx;
        y += dy;
    }

    return true;
}
