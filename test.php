<?php
//测试专用,可删除

namespace kj1;
const MN="meituan";
function getMsg(){
    echo "ddd";
}


namespace kj2;
const MN="meituan";
function getMsg(){
    echo "123";
}

\kj1\getMsg();