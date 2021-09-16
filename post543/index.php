<?php
// よくある解答
for ($i = 1; $i <= 100; ++$i) {
  if ($i % 15 === 0) echo 'FizzBuzz';
  elseif ($i % 3 === 0) echo 'Fizz';
  elseif ($i % 5 === 0) echo 'Buzz';
  else echo $i;
}

// でたらめインデント
  for ($i = 1; $i <= 100; ++$i) {
    if ($i % 15 === 0) echo 'FizzBuzz';
 elseif ($i % 3 === 0) echo 'Fizz';
   elseif ($i % 5 === 0) echo 'Buzz';
       else echo $i;
     }

// ぼくのかんがえたさいきょうの if ぶん
  for ($i = 1; $i <= 100; ++$i) {
    if ($i % 15 === 0)
{echo 'FizzBuzz';
}
 elseif ($i % 3 === 0) {echo 'Fizz';}
   elseif ($i % 5 === 0)
{
echo 'Buzz';
}
       else {echo $i;
  }
     }

// すし詰めコード
  for( $i = 1; $i <= 100; ++$i ){
    if ($i%15===0)
{echo     'FizzBuzz';
}
 elseif  (  $i  %  3  ===  0  ) {  echo  'Fizz'  ;  }
   elseif($i%5===0)
 {
echo'Buzz';
}
       else  { echo$i ;
  }
     }

// 空の変数名
  for( $🐊 = 1; $🐊 <= 100; ++$🐊 ){
    if ($🐊%15===0)
{echo     'FizzBuzz';
}
 elseif  (  $🐊  %  3  ===  0  ) {  echo  'Fizz'  ;  }
   elseif($🐊%5===0)
 {
echo'Buzz';
}
       else  { echo$🐊 ;
  }
     }

// マジックナンバー（改）
  for( $🐊 = 0x1; $🐊 <= 0144; ++$🐊 ){
    if ($🐊%0b1111===00)
{echo     'FizzBuzz';
}
 elseif  (  $🐊  %  0b11  ===  0_00_000  ) {  echo  'Fizz'  ;  }
   elseif($🐊%0b101===0x0)
 {
echo'Buzz';
}
       else  { echo$🐊 ;
  }
     }

// Go To トラブル
  $🐊=0x0;ك:if( ++$🐊 <= 0144  ){
    if ($🐊%0b1111===00)
{echo     'FizzBuzz';
}
 elseif  (  $🐊  %  0b11  ===  0_00_000  ) {  echo  'Fizz'  ;  }
   elseif($🐊%0b101===0x0)
 {
echo'Buzz';
}
       else  { echo$🐊 ;
  }
     goto ك;}

// ノーコメもありや
  $🐊=0x0;كI:if( ++$🐊 <= 0144  ){ // 100 R.I.P.
    if ($🐊%0b1111===00) //ifで判定しています。。。
{echo     'FizzBuzz';
} //TODO:〇〇さん修正よろしく(^_−)−☆
 elseif  (  $🐊  %  0b11  ===  0_00_000  ) {  echo  'Fizz'  ;  }
   elseif($🐊%0b101===0x0)
 {
echo'Buzz';
}//強強打破3つ並べて一気飲みするのジェットストリームアタックって言うの草
       else  { echo$🐊 ;
  }
     goto كI;}//    var_dump($🐊);

// デザイナー殺し
 $𓁿=''; $🐊=0x0;كl:if( ++$🐊 <= 0144  ){ // 100 R.I.P.
    if ($🐊%0b1111===00) //ifで判定しています。。。
{     $𓁿.=    "Fizz".'Buzz';
} //TODO:〇〇さん修正よろしく(^_−)−☆
 elseif  (  $🐊  %  0b11  ===  0_00_000  ) {  $𓁿 .='Fizz'  ;  }
   elseif($🐊%0b101===0x0)
 {
$𓁿.= "Buzz";
}//強強打破3つ並べて一気飲みするのジェットストリームアタックって言うの草
       else  { $𓁿.=$🐊 ;
  }
     goto كl;}echo$𓁿;//    var_dump($🐊);
