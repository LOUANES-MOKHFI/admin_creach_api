<!-- main-header opened -->
<style>

.notifications .fa {
    color:#cecece;
    line-height:60px;
    font-size:22px;
}
.notifications .num {
    position:absolute;
    top:0px;
    right:0px;
    width:15px;
    height:15px;
    border-radius:50%;
    background:#ff2c74;
    color:#fff;
    font-size: 12px;
    line-height:15px;
    font-family:sans-serif;
    text-align:center;
}
.fixed-navbar .ico-item{
	display: inline-block;
}

.newRdv{
    color: red;
}

</style>
<div class="main-header sticky side-header nav nav-item">
	<div class="container-fluid">
		<div class="main-header-left ">
			<div class="responsive-logo">
				<a href="{{ route('admin') }}">Rawdati</a>

			</div>
			<div class="app-sidebar__toggle" data-toggle="sidebar">
				<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
				<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
			</div>
			
		</div>
		<div class="main-header-right">
			
			<div class="nav nav-item  navbar-nav-right ml-auto">
				@if(auth('admins')->user())
				<div class="dropdown nav-item main-header-notification">
					<a class="new nav-link url_notify ico-item notifications ico-item-notif notice-alarm js__toggle_open" data-target="#message-popup1">
							<i class="fa fa-bell notice-alarm" ></i>
						<span class="num notif_admin" data-count="{{count(Notifications())}}">{{count(Notifications())}}</span>
					</a>
					<div class="dropdown-menu">
	
						<div class="menu-header-content bg-primary text-right">
							<div class="d-flex">
								<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الإشعارات</h6>
							</div>
							<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">الإشعارات الجديدة</p>
						</div>
						<div class="main-message-list chat-scroll ">
							@if(count(Notifications()) > 0)
							@foreach(Notifications() as $key => $notification)
							<a href="{{$notification->link}}" class="p-3 d-flex border-bottom">
								<div class="wd-90p">
									@if($notification->model == "\App\Models\User")
									<div class="d-flex">
										<h6 class="mb-1 name">
											@if(Account($notification->uuid_model)->type =="user")
												<span class="badge badge-danger">مستخدم</span>
											@elseif(Account($notification->uuid_model)->type == "creche")
												<span class="badge badge-success">روضة</span>
											@elseif(Account($notification->uuid_model)->type == "vendeur")
												<span class="badge badge-info">متجر</span>
											@endif
										</h6>
										<h5 class="mb-1 name">{{Account($notification->uuid_model)->name}}</h5>
									</div>
									<p class="mb-0 desc">{{Account($notification->uuid_model)->email}}</p>
									@endif
									@if($notification->model == "\App\Models\Blog")
									<div class="d-flex">
										<h6 class="mb-1 name">
											@if(Blog($notification->uuid_model)->type =="blog")
												<span class="badge badge-danger">مقالة</span>
											@elseif(Blog($notification->uuid_model)->type == "contribution")
												<span class="badge badge-success">مساهمة</span>
											@endif
										</h6>
										<h5 class="mb-1 name">{{Blog($notification->uuid_model)->title}}</h5>
									</div>
									<p class="mb-0 desc">{{Blog($notification->uuid_model)->creche->name}}</p>
									<p class="mb-0 desc">{{Blog($notification->uuid_model)->creche->email}}</p>
									@endif
									<p class="time mb-0 text-left float-right mr-2 mt-2">{{$notification->created_at}}</p>
								</div>
							</a>
							@endforeach
							@endif
							
						</div>
						<div class="text-center dropdown-footer">
							<a href="{{route('admin.notifications')}}" class="text-center">عرض كل الإشعارات</a>
						</div>
					</div>
					
				</div>
				<div class="dropdown nav-item main-header-notification">
					<a class="new nav-link ico-item notifications ico-item-notif notice-alarm js__toggle_open" data-target="#message-popup">
		        		<i class="fa fa-calendar notice-alarm" ></i>
		        		<span class="num demande_rdv" data-count="{{\App\Models\Contact::where('is_viewed',0)->count()}}">{{\App\Models\Contact::where('is_viewed',0)->count()}}</span>
		        	</a>
		        	<div class="dropdown-menu">
						
						<div class="menu-header-content bg-primary text-right">
							<div class="d-flex">
								<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الرسائل</h6>
							</div>
							<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">الرسائل الجديدة</p>
						</div>
						<div class="main-message-list chat-scroll ps ps--active-y">
							@if(\App\Models\Contact::where('is_viewed',0)->count() > 0)
							@foreach(Messages() as $key => $message)
							<a href="{{route('admin.contacts.show',$message->uuid)}}" class="p-3 d-flex border-bottom">
								<div class="wd-90p">
									<div class="d-flex">
										<h5 class="mb-1 name">{{$message->name}}</h5>
									</div>
									<p class="mb-0 desc">{{$message->email}}</p>
									<p class="time mb-0 text-left float-right mr-2 mt-2">{{$message->created_at}}</p>
								</div>
							</a>
							@endforeach
							@endif	
						</div>
						<div class="text-center dropdown-footer">
							<a href="{{route('admin.contacts')}}" class="text-center">عرض كل الرسائل</a>
						</div>
					</div>
					
				</div>
				
				
				@endif
				<audio id="audioNotify" src="/admin/assets/beep/beep1.mp3" type="audio/wav">

		        </audio> 

				<div class="dropdown main-profile-menu nav nav-item nav-link">
					<a class="profile-user d-flex" href=""><img alt="" src="{{asset('admin/assets/img/faces/6.jpg')}}"></a>
					<div class="dropdown-menu">
						<div class="main-header-profile bg-primary p-3">
							<div class="d-flex wd-100p">
								<div class="main-img-user"><img alt="" src="{{asset('admin/assets/img/faces/6.jpg')}}" class=""></div>
								<div class="mr-3 my-auto">
									<h6> {{Auth::user()->name}}</h6><span> {{auth('admins')->user()->role == null ? '' : auth('admins')->user()->role->name}}</span>
								</div>
							</div>
						</div>
						<a class="dropdown-item" href="#"><i class="bx bx-user-circle"></i>حسابي</a>
						<a class="dropdown-item" href="{{route('admin.settings')}}"><i class="bx bx-cog"></i>اعدادات عامة</a>
						<a class="dropdown-item" href="{{route('admin.logout')}}"><i class="bx bx-log-out"></i>تسجيل الخروج</a>

                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
	function sound(){
		let sound = document.getElementById("audioNotify");
		sound.play()
	}
		Pusher.logToConsole = true;
        var pusher = new Pusher('896d5c9b154c69b02817', {
        cluster: 'eu'
        });

        ////Notification new account
        var channel = pusher.subscribe('new-user-register');
        channel.bind('new-user-event', function(data) {
            //console.log(data);
			if(data.type =="user"){
				var type = `<span class="badge badge-danger">مستخدم</span>`
			}
			if(data.type == "creche"){
				var type = `<span class="badge badge-success">روضة</span>`
			}
			if(data.type == "vendeur"){
				var type = `<span class="badge badge-info">متجر</span>`
			}
											 
                sound();
                var count_notif = parseInt(1);
                count_notif = count_notif + parseInt($('.notif_admin').attr('data-count'));
                $(".notif_admin").attr('data-count',count_notif);
                $(".notif_admin").html(count_notif);
                //$(".rdv_list").html()
                var notification = 
					`
						<a href="`+data.link+`" class="p-3 d-flex border-bottom">
							<div class="wd-90p">
								<div class="d-flex">
									<h6 class="mb-1 name">`+type+`</h6>
									<h5 class="mb-1 name">`+data.name+`</h5>
								</div>
								<p class="mb-0 desc">`+data.email+`</p>
								<p class="time mb-0 text-left float-right mr-2 mt-2">`+data.date+`</p>
							</div>
						</a>
					`;
                $(".main-message-list").prepend(notification);

        });


		////Notification new blog
        var channel = pusher.subscribe('new-blog');
        channel.bind('new-blog-event', function(data) {
            console.log(data);
			var type = ''
			if(data.type =="blog"){
				type = `<span class="badge badge-danger">مقالة</span>`
			}
			if(data.type == "contribution"){
				type = `<span class="badge badge-success">مساهمة</span>`
			}						 
                sound();
                var count_notif = parseInt(1);
                count_notif = count_notif + parseInt($('.notif_admin').attr('data-count'));
                $(".notif_admin").attr('data-count',count_notif);
                $(".notif_admin").html(count_notif);
                //$(".rdv_list").html()
                var notification = 
					`
						<a href="`+data.link+`" class="p-3 d-flex border-bottom">
							<div class="wd-90p">
								<div class="d-flex">
									<h6 class="mb-1 name">`+type+`</h6>
									<h5 class="mb-1 name">`+data.title+`</h5>
								</div>
								<p class="mb-0 desc">`+data.name+`</p>
								<p class="mb-0 desc">`+data.email+`</p>
								<p class="time mb-0 text-left float-right mr-2 mt-2">`+data.date+`</p>
							</div>
						</a>
					`;
                $(".main-message-list").prepend(notification);

        });



  </script>