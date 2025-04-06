
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

