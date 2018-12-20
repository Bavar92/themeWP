<?php get_header(); ?>
    <div id="content" class="container cfx">
        <main>
            <article>
                <div class="cog_container">
                    <div class="cog_overlay">
                    </div>
                    <span class="fas fa-cog cog_icon cog_top"></span>
                    <span class="fas fa-cog cog_icon cog_left"></span>
                    <span class="fas fa-cog cog_icon cog_right"></span>
                </div>
                <h1><i>404</i> Page Not Found</h1>
                <p>The article you were looking for was not found, but maybe try looking again!</p>
            </article>
        </main>
    </div>
    <style>
        .error404 main {
            margin: 0 0 40px;
            text-align: center;
        }
        .error404 h1 {
            font-size: 18px;
            margin: 30px 0 20px;
        }
        .error404 h1 i {
            font-size: 50px;
            display: block;
            margin-bottom: 20px;
        }
        .error404 .cog_top {
            top: 0;
            left: 50px;
            animation: simple_rotate 10s 0s infinite linear;
        }
        .error404 .cog_top:before {
            font-size: 100px;
            color: #999;
        }
        .error404 .cog_left {
            top: 97px;
            left: 35px;
            -webkit-transform: rotate(48deg);
            -ms-transform: rotate(48deg);
            transform: rotate(48deg);
            animation: rotate_left 10s 0.1s infinite reverse linear;
            color: #666;
        }
        .error404 .cog_left:before {
            font-size: 100px;
        }
        .error404 .cog_right {
            top: 134px;
            left: 127px;
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
            animation: rotate_right 10s 0.2s infinite linear;
        }
        .error404 .cog_right:before {
            font-size: 100px;
            color: #444;
        }
        .error404 .cog_container {
            position: relative;
            width: 280px;
            height: 260px;
            margin: 0 auto;
        }
        .error404 .cog_container .cog_overlay {
            position: absolute;
            z-index: -1;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 150px;
            height: 150px;
            margin: auto;
            border-radius: 100%;
            background: transparent;
            box-shadow: 0 0 0 100px rgba(255, 255, 255, .9), 0 0 8px 0 rgba(0, 0, 0, .36) inset;
        }
        .error404 .cog_container .cog_icon {
            position: absolute;
            z-index: -2;
        }
        @keyframes simple_rotate {
            from {
                -webkit-transform: rotate(30deg);
                transform: rotate(30deg);
            }
            to {
                -webkit-transform: rotate(390deg);
                transform: rotate(390deg);
            }
        }
        @keyframes rotate_left {
            from {
                -webkit-transform: rotate(16deg);
                transform: rotate(16deg);
            }
            to {
                -webkit-transform: rotate(376deg);
                transform: rotate(376deg);
            }
        }
        @keyframes rotate_right {
            from {
                -webkit-transform: rotate(4deg);
                transform: rotate(4deg);
            }
            to {
                -webkit-transform: rotate(364deg);
                transform: rotate(364deg);
            }
        }
    </style>
<?php get_footer(); ?>