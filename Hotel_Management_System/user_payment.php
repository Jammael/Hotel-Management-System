<!DOCTYPE html>
<html>
<head>
	<title>User Payment</title>
</head>
<style>
	body {
	  margin: 0;
	  background: #f2f2f2;
	}
	table {
		font-size: 22px;
	}
	.basic_box {
		border: 1px solid #ccc;
		border-radius: 15px;
		margin: auto;
		width: 600px;
		padding: 50px;
		box-shadow: 0 10px 20px rgba(0,0,0,0.19);
	}
	#td1
	{
		background-color: rgba(09,41,98,0.9);
		color: white;
		border: 10px;
		margin-top: -10px;
		padding: 10px;
		text-align: center;
	}
	td {
		text-align: center;
	}
	ul {
	  	list-style-type: none;
	  	margin: 0;
	  	padding: 0;
	  	width: 22%;
	  	font-size: 24px;
	  	background-color: rgba(09,41,98,0.9);
	  	text-decoration: none;
	  	position: fixed;
	  	height: 100%;
	  	overflow: auto;
	}
	li {
		color: white;
	}
	li a {
	  	display: block;
	  	color: white;
	  	padding: 8px 16px;
	  	text-decoration: none;
	}
	li a:visited {
	  	background-color: #e6b800;
	  	color: white;
	  	text-decoration: underline;	
	}
	li a:active {
	  	background-color: #e6b800;
	  	color: white;
	  	text-decoration: underline;		
	}
	li a:hover {
	  	background-color: #e6b800;
	  	color: white;
	  	text-decoration: underline;
	}
</style>
<body>
	<?php
		$conn = new mysqli("localhost","root","", "iwp");
		if($conn->connect_error)
		{
			die("Connection failed: ".$conn->connect_error);
		}
		$sql = "SELECT * from temp_session";
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_row($result); ?>
	<table style="width: 100%;">
		<tr>
			<td id="td1" style="padding: 10px; font-size: 48px;">THE <p style="color: #e6b800; display: inline;">DELUXE</p> HOTEL</td>
			<td id="td1" style="font-size: 25px; text-align: right;">Hello, <?php echo $row[2]; ?></td>
		</tr>
	</table>
	<ul>
		<li><a href="user_view.php">My Info</a></li>
		<li><a href="bookroom.php">Book A Room</a></li>
		<li><a href="user_room_status.php">Show Booking Status</a></li>
		<li><a href="user_payment.php">Payment</a></li>
		<li><a href="user_booking_history.php">Booking History</a></li>
		<li><a href="index.php">Logout</a></li>
	</ul>
	<div style="margin-left:25%;padding:1px 16px;height:1000px;">
		<div class="basic_box">
			<h2 style="text-align:center; text-decoration:underline;">Payment</h2>
			<?php
				// fetch confirmed bookings and render as data rows for JS lookup
				$conn = new mysqli("localhost","root","", "iwp");
				if($conn->connect_error) { die("Connection failed: ".$conn->connect_error); }
				$sql1 = "SELECT * from confirmed_booking";
				$bookings = [];
				if ($result=mysqli_query($conn,$sql1)) {
					// fetch both associative and numeric so index-based columns like [13]/[14] are available
					while ($row=mysqli_fetch_array($result, MYSQLI_BOTH)) {
						$bookings[] = $row;
					}
					mysqli_free_result($result);
				}
			?>

			<div id="ewallet-ui" style="max-width:520px;margin:0 auto;">
				<label style="display:block;margin-bottom:8px;font-weight:bold;">Select E-wallet</label>
				<div style="display:flex;gap:12px;margin-bottom:18px;">
					<button type="button" class="ewallet-btn" data-provider="Gcash" style="flex:1;padding:12px;border-radius:10px;border:1px solid #e6b; background:#fff;">GCash</button>
					<button type="button" class="ewallet-btn" data-provider="Paymaya" style="flex:1;padding:12px;border-radius:10px;border:1px solid #e6b; background:#fff;">PayMaya</button>
					<button type="button" class="ewallet-btn" data-provider="PalawanPay" style="flex:1;padding:12px;border-radius:10px;border:1px solid #e6b; background:#fff;">PalawanPay</button>
				</div>

				<div style="margin-bottom:12px;">
					<label>Booking ID</label>
					<input id="book-id" type="text" placeholder="Enter booking id or click a row below" style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;" />
				</div>
				<div style="margin-bottom:12px;display:flex;gap:8px;">
						<div style="flex:1;">
						<label>Amount</label>
						<input id="amount" type="text" readonly style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;background:#f7f7f7;" />
					</div>
					<div style="flex:1;">
						<label>Phone (e-wallet)</label>
						<input id="phone" name="phone" type="text" placeholder="09XXXXXXXXX" style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;" />
					</div>
				</div>
				<div style="margin-bottom:12px;">
					<label>Transaction PIN / Reference</label>
					<input id="txn_ref" type="password" placeholder="Enter transaction PIN or ref" style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;" />
				</div>

				<form id="pay-form" action="payment.php" method="post">
					<input id="form-book-id" name="book_id" type="hidden" />
					<input id="form-gateway" name="gateway" type="hidden" />
					<input id="form-phone" name="phone" type="hidden" />
					<input id="form-txn_ref" name="txn_ref" type="hidden" />
					<div style="text-align:center;margin-top:16px;">
						<button id="pay-now" type="button" style="background:linear-gradient(180deg,#ff6b6b,#e64545);color:#fff;border:none;padding:12px 40px;border-radius:12px;font-size:18px;">Submit</button>
					</div>
				</form>

				<hr style="margin:18px 0;">
				<p style="font-weight:bold;">Your confirmed bookings</p>
				<div id="bookings-list" style="max-height:220px;overflow:auto;border-radius:8px;border:1px solid #eee;padding:8px;">
					<?php if (count($bookings)===0) { echo '<p>No confirmed bookings found.</p>'; } else {
						echo '<table style="width:100%;font-size:14px;border-collapse:collapse;">';
						echo '<tr style="font-weight:bold;background:#f3f3f3;"><td>Booking ID</td><td>Name</td><td>Room</td><td style="text-align:right">Amount</td></tr>';
						foreach($bookings as $b) {
							// determine book id and amount keys - try common keys
							$bid = '';
							if (isset($b['book_id'])) $bid = $b['book_id'];
							elseif (isset($b['bookid'])) $bid = $b['bookid'];
							elseif (isset($b[14])) $bid = $b[14];
							$amt = '';
							if (isset($b['price'])) $amt = $b['price'];
							elseif (isset($b['amount'])) $amt = $b['amount'];
							elseif (isset($b[13])) $amt = $b[13];
							$name = isset($b['name']) ? $b['name'] : (isset($b[1]) ? $b[1] : '');
							$room = isset($b['room_type']) ? $b['room_type'] : (isset($b[3]) ? $b[3] : '');
							echo '<tr class="booking-row" data-book-id="'.htmlspecialchars($bid).'" data-amount="'.htmlspecialchars($amt).'" style="cursor:pointer;"><td>'.htmlspecialchars($bid).'</td><td>'.htmlspecialchars($name).'</td><td>'.htmlspecialchars($room).'</td><td style="text-align:right">'.htmlspecialchars($amt).'</td></tr>';
						}
						echo '</table>';
					} ?>
				</div>
			</div>
		</div>
	</div>

	<script>
	// small JS to wire interactions
	(function(){
		const eBtns = document.querySelectorAll('.ewallet-btn');
		let selected = '';
		eBtns.forEach(b=>b.addEventListener('click', ()=>{
			eBtns.forEach(x=>x.style.boxShadow='none');
			b.style.boxShadow='0 6px 18px rgba(0,0,0,0.2) inset';
			selected = b.dataset.provider;
		}));

		// when booking row clicked fill inputs
		document.querySelectorAll('.booking-row').forEach(row=>{
			row.addEventListener('click', ()=>{
				const bid = row.dataset.bookId;
				const amt = row.dataset.amount;
				document.getElementById('book-id').value = bid;
				document.getElementById('amount').value = amt;
			});
		});

		// when user types a booking id, fill amount automatically if matching booking exists
		document.getElementById('book-id').addEventListener('input', function(){
			const val = this.value.trim();
			if(!val) { document.getElementById('amount').value=''; return; }
			const rows = document.querySelectorAll('.booking-row');
			for(let r of rows){ if(r.dataset.bookId == val){ document.getElementById('amount').value = r.dataset.amount; break; } }
		});

		document.getElementById('pay-now').addEventListener('click', ()=>{
			const bid = document.getElementById('book-id').value.trim();
			const phone = document.getElementById('phone').value.trim();
			const txn = document.getElementById('txn_ref').value.trim();
			if(!selected) { alert('Please select an e-wallet provider.'); return; }
			if(!bid) { alert('Please enter or choose a Booking ID.'); return; }
			if(!phone) { if(!confirm('No phone entered. Continue?')) return; }
			// set hidden form fields and submit
			document.getElementById('form-book-id').value = bid;
			document.getElementById('form-gateway').value = selected;
			document.getElementById('form-phone').value = phone;
			document.getElementById('form-txn_ref').value = txn;
			// show simple confirm
			if(confirm('Proceed to pay '+document.getElementById('amount').value+' via '+selected+'?')){
				document.getElementById('pay-form').submit();
			}
		});
	})();
	</script>
</body>
</html>