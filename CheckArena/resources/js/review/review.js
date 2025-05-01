 
 console.log(moves);
 
    document.addEventListener('DOMContentLoaded', function() {
        
        const pieceMap = {
            '1': 'https://assets-themes.chess.com/image/ejgfv/150/wp.png',
            '2': 'https://assets-themes.chess.com/image/ejgfv/150/wr.png',
            '3': 'https://assets-themes.chess.com/image/ejgfv/150/wn.png',
            '4': 'https://assets-themes.chess.com/image/ejgfv/150/wb.png',
            '5': 'https://assets-themes.chess.com/image/ejgfv/150/wq.png',
            '6': 'https://assets-themes.chess.com/image/ejgfv/150/wk.png',
            '-1': 'https://assets-themes.chess.com/image/ejgfv/150/bp.png',
            '-2': 'https://assets-themes.chess.com/image/ejgfv/150/br.png',
            '-3': 'https://assets-themes.chess.com/image/ejgfv/150/bn.png',
            '-4': 'https://assets-themes.chess.com/image/ejgfv/150/bb.png',
            '-5': 'https://assets-themes.chess.com/image/ejgfv/150/bq.png',
            '-6': 'https://assets-themes.chess.com/image/ejgfv/150/bk.png'
        };
        
        
        let defaultPosition = [
            [-2, -3, -4, -5, -6, -4, -3, -2],
            [-1, -1, 0, -1, -1, -1, -1, -1],
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, -1, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 3, 0, 0],
            [1, 1, 1, 0, 0, 1, 1, 1],
            [2, 3, 4, 5, 6, 4, 0, 2]
        ];
        
})