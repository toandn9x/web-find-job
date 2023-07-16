@extends('workwise.layouts.master')
@section('style')
    <link rel="stylesheet" href="/workwise/css/dashboard/style.css">
@endsection
@section('main-content')
<div class="wrapper">
    <div class="glitch_word_box">
        <div class="line"></div>
        <h1 id="word" class="glitch_word0">403 - Unauthornize</h1>
        <h1 id="word1" class="glitch_word1">403 - Unauthornize</h1>
        <h1 id="word2" class="glitch_word2">403 - Unauthornize</h1>
    </div>
</div>
<style>
h1 {
				color: #e44d3a;
				font-weight: bolder;
				font-size: 5em;
				margin: 0;
				outline: none;
				padding: 0;
				position: relative;
}
			
.glitch_word_box {
    text-align: center;
				height: 100vh;
                display: flex;
                align-items: center;
				line-height: 100vh;
				position: relative;
				
				-webkit-animation: disappear 1s linear;
				-webkit-animation-iteration-count: infinite, infinite;
				-moz-animation: disappear 1s linear;
				-moz-animation-iteration-count: infinite, infinite;
				-o-animation: disappear 1s linear;
				-o-animation-iteration-count: infinite, infinite;
}
			
.glitch_word_box .glitch_word0 {
				position: absolute;
				width: 100%;
}
			
.glitch_word_box .glitch_word1 {
				color: red;
				font-weight: bolder;
				left: -2px;
				position: absolute;
				top: -2px;
				width: 100%;
				z-index: -1;	
				
				-webkit-animation: animate_glitch_1 .2s linear;
				-webkit-animation-iteration-count: infinite;	
				-moz-animation: animate_glitch_1 .2s linear;
				-moz-animation-iteration-count: infinite;	
				-o-animation: animate_glitch_1 .2s linear;
				-o-animation-iteration-count: infinite;	
}
			
.glitch_word_box .glitch_word2 {
				color: blue;
				font-weight: bolder;
				left: 2px;
				position: absolute;
				top: 2px;
				width: 100%;
				z-index: -1;
				
				-webkit-animation: animate_glitch_2 .3s linear;
				-webkit-animation-iteration-count: infinite;
  		-moz-animation: animate_glitch_2 .3s linear;
				-moz-animation-iteration-count: infinite;
  		-o-animation: animate_glitch_2 .3s linear;
				-o-animation-iteration-count: infinite;
}
			
@-webkit-keyframes disappear {
				0% {	opacity: 0;	}
				2% { opacity: 1; }
}
						
@-webkit-keyframes animate_glitch_1 {
			  	0% { top: 1px; left: 1px; }
			 	25% { top: 3px; left: 2px;	 }
		 		50% { top: -1px; left: -4px;	}
			 	75% { top: 2px; left: 5px;	}
				100% {	top: 1px; left: -2px;	}			
}
			
@-webkit-keyframes animate_glitch_2 {
			  	0% { top: -1px; left: -1px;	}
 				25% { top: -3px; left: -2px;	}
 				50% { top: 1px; left: 4px; }
				100% { top: -1px; left: -1px; }			
}

@-moz-keyframes disappear {
				0% {	opacity: 0;	}
				2% { opacity: 1; }
}
						
@-moz-keyframes animate_glitch_1 {
			  	0% { top: 1px; left: 1px; }
			 	25% { top: 3px; left: 2px;	 }
		 		50% { top: -1px; left: -4px;	}
			 	75% { top: 2px; left: 5px;	}
				100% {	top: 1px; left: -2px;	}			
}
			
@-moz-keyframes animate_glitch_2 {
			  	0% { top: -1px; left: -1px;	}
 				25% { top: -3px; left: -2px;	}
 				50% { top: 1px; left: 4px; }
				100% { top: -1px; left: -1px; }			
}

@-o-keyframes disappear {
				0% {	opacity: 0;	}
				2% { opacity: 1; }
}
						
@-o-keyframes animate_glitch_1 {
			  	0% { top: 1px; left: 1px; }
			 	25% { top: 3px; left: 2px;	 }
		 		50% { top: -1px; left: -4px;	}
			 	75% { top: 2px; left: 5px;	}
				100% {	top: 1px; left: -2px;	}			
}
			
@-o-keyframes animate_glitch_2 {
			  	0% { top: -1px; left: -1px;	}
 				25% { top: -3px; left: -2px;	}
 				50% { top: 1px; left: 4px; }
				100% { top: -1px; left: -1px; }			
}
</style>
@endsection