<style>
    .box-profile{
        width: 100% !important;
        border: 1px solid #ccc;
        height: 100% !important;
    }
    .left{
        position: relative;
        border-right: 1px solid #ccc;
        height: 500px;
        width: 20%;
    }
    .right{
        width: 80%;
        overflow-y:  auto;
        height: 500px;
    }
    .profile-image{
        max-width: 150px;
    }
    .user-info{
        border-bottom: 1px solid #ccc;
        width: 100%;
    }
    .menu {
        width: 100%;
        margin-bottom: 40px;
    }
    .user-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .menu a{
        border-bottom: 1px solid #ccc;
        padding: 5px;
    }
</style>
<div class="container-xl ">
    <div class="box-profile mt-3 d-flex w-100">
        <div class="left  d-flex justify-content-center align-items-center flex-column">
            <div class="user-info p-2">
                <img class="rounded-3 profile-image" src="/storage/profiles_images/{{Auth::user()->profile->image}}"  alt=""></a>
                <h2 class="text-center mt-2">Olá {{Auth::user()->name}}</h2>
            </div>
            <div class="menu d-flex justify-content-start flex-column">
                <a id="menu-link" href="{{route('config-user-profile')}}">Principal</a>
                <a href="{{route('config-public-profile')}}">Perfil Público</a>
            </div>
        </div>
        <div class="right p-3">
            @yield('menu')
        </div>
    </div>

</div>
