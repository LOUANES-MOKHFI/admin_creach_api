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
				@can('Myintervention')
				<div class=" nav-item main-header-notification">
					<a href="{{route('admin.Myintervention')}}" class="new nav-link notifications ico-item-notif">
				        <i class="fa fa-bell notice-alarm"></i>
				        <span class="num notif_user" data-count="{{Count_notification()->count_notify}}">{{Count_notification()->count_notify}}</span>
				    </a>
					
				</div>
				@endcan
				@if(auth('admins')->user()->is_notified == 1)
				<div class="dropdown nav-item main-header-notification">
					<a class="new nav-link ico-item notifications ico-item-notif notice-alarm js__toggle_open" data-target="#message-popup">
		        		<i class="fa fa-calendar notice-alarm" ></i>
		        		<span class="num demande_rdv" data-count="{{DemandeRDV()->count()}}">{{DemandeRDV()->count()}}</span>
		        	</a>
		        	<div class="dropdown-menu">
	
						<div class="menu-header-content bg-primary text-right">
							<div class="d-flex">
								<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Demandes des RDV</h6>
							</div>
							<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">Nouvelle demandes</p>
						</div>
						<div class="main-message-list chat-scroll">
							@if(DemandeRDV()->count() > 0)
							@foreach(DemandeRDV() as $key => $demande)
							<a href="{{route('admin.reservations.show',$demande->id)}}" class="p-3 d-flex border-bottom">
								<div class="wd-90p">
									<div class="d-flex">
										<h5 class="mb-1 name">{{$demande->Fname.' '.$demande->Lname}}</h5>
									</div>
									<p class="mb-0 desc">{{$demande->email}}</p>
									<p class="time mb-0 text-left float-right mr-2 mt-2">{{$demande->created_at}}</p>
								</div>
							</a>
							@endforeach
							@endif
							
						</div>
						<div class="text-center dropdown-footer">
							<a href="{{route('admin.reservations')}}" class="text-center">Voir toutes les demandes</a>
						</div>
					</div>
					
				</div>

				<div class="nav-item main-header-notification">
					<a class="new nav-link url_notify ico-item notifications ico-item-notif" href="">
							<i class="fa fa-bell notice-alarm" ></i>
						<span class="num notif_admin" data-count="0">0</span>
					</a>
					
				</div>
				@endif
				<audio id="audioNotify" src="/admin/assets/beep/beep2.mp3" type="audio/wav">

		        </audio> 
		        <audio id="audioNotify_billan" src="/admin/assets/beep/beep.mp3" type="audio/wav">

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
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

