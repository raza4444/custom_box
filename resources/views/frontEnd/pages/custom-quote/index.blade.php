@extends('frontEnd.main')
@section('content')

<!-- Begin FB's Breadcrumb Area -->
<div class="breadcrumb-area pt-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-content">
					<ul>
						<li><a href="/">Home</a></li>
						<li class="active">Request Quote</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- FB's Breadcrumb Area End Here -->

<div class="checkout-area pt-60 pb-30">
	<div class="container">

		@if(Session::has('success_msg'))
		<div class="alert alert-success">
  <span>{{ Session::get('success_msg') }}</span>
  </div>
@endif
		<div class="row">

			<div class="col-12">
				<form action="{{ route('customRequestForQuote')}}" method="post">
					<div class="checkbox-form">
						<h3>Request Quote</h3>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>First Name <span class="required">*</span></label>
									<input placeholder="" required type="text" name="first_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Last Name <span class="required">*</span></label>
									<input placeholder="" required type="text" name="last_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Email Address <span class="required">*</span></label>
									<input placeholder="" type="email" required name="email">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Phone  <span class="required">*</span></label>
									<input type="text" name="phone" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="country-select clearfix">
									<label>Box Style <span class="required">*</span></label>
									<select name="box_style" required class="nice-select wide">
										<option value="1-2-3 Bottom">1-2-3 Bottom</option> <option value="1-2-3 Bottom Display Lid">1-2-3 Bottom Display Lid</option> <option value="4 Corner Tray Tuck Top">4 Corner Tray Tuck Top</option> <option value="4 Corner Tray With Lid">4 Corner Tray With Lid</option> <option value="4 Pk Bottle Carrier">4 Pk Bottle Carrier</option> <option value="Archive Boxes">Archive Boxes</option> <option value="Auto Bottom Tray">Auto Bottom Tray</option> <option value="Auto Bottom with Display Lid">Auto Bottom with Display Lid</option> <option value="Auto Lock Cap">Auto Lock Cap</option> <option value="Bag Shaped Box Auto Bottom">Bag Shaped Box Auto Bottom</option> <option value="Bags">Bags</option> <option value="Bakery Boxes">Bakery Boxes</option> <option value="Book Boxes">Book Boxes</option> <option value="Bookend">Bookend</option> <option value="Bookend CD Case">Bookend CD Case</option> <option value="Booklets">Booklets</option> <option value="Bookmarks">Bookmarks</option> <option value="Bowl Sleeve">Bowl Sleeve</option> <option value="Box With Hanging and Locking Tabs">Box With Hanging and Locking Tabs</option> <option value="Brochure Display Holder">Brochure Display Holder</option> <option value="Brochures">Brochures</option> <option value="Business Card Boxes">Business Card Boxes</option> <option value="Business Cards">Business Cards</option> <option value="Bux Board Boxes">Bux Board Boxes</option> <option value="Cake Boxes">Cake Boxes</option> <option value="Candle Boxes">Candle Boxes</option> <option value="Candy Boxes">Candy Boxes</option> <option value="Cardboard Boxes">Cardboard Boxes</option> <option value="CD Jackets">CD Jackets</option> <option value="CD/DVD storage Boxes">CD/DVD storage Boxes</option> <option value="Cereal Boxes">Cereal Boxes</option> <option value="Chinese Food Boxes">Chinese Food Boxes</option> <option value="Chinese Takeout Boxes">Chinese Takeout Boxes</option> <option value="Chocolate Boxes">Chocolate Boxes</option> <option value="Cigarette Boxes">Cigarette Boxes</option> <option value="Coffee Boxes">Coffee Boxes</option> <option value="Cookie Boxes">Cookie Boxes</option> <option value="Corrugated Boxes">Corrugated Boxes</option> <option value="Cosmetic Display Boxes">Cosmetic Display Boxes</option> <option value="Counter Display Boxes">Counter Display Boxes</option> <option value="Cream Boxes">Cream Boxes</option> <option value="Cube Boxes">Cube Boxes</option> <option value="Cube Shaped Carrier">Cube Shaped Carrier</option> <option value="CupCake Boxes">CupCake Boxes</option> <option value="Custom Boxes">Custom Boxes</option> <option value="Decals">Decals</option> <option value="Die Cut Boxes">Die Cut Boxes</option> <option value="Disc Folder">Disc Folder</option> <option value="Dispenser">Dispenser</option> <option value="Display Box Auto Bottom">Display Box Auto Bottom</option> <option value="Display Boxes">Display Boxes</option> <option value="Document Folder">Document Folder</option> <option value="Donut Boxes">Donut Boxes</option> <option value="Door Hanger">Door Hanger</option> <option value="Double Glue Side Wall">Double Glue Side Wall</option> <option value="Double Glued Side Wall Tray and Sleeve">Double Glued Side Wall Tray and Sleeve</option> <option value="Double Locked Wall Lid">Double Locked Wall Lid</option> <option value="Double Wall Display Lid">Double Wall Display Lid</option> <option value="Double Wall Frame Tray">Double Wall Frame Tray</option> <option value="Double Wall Frame Tray Lid">Double Wall Frame Tray Lid</option> <option value="Double Wall Tray">Double Wall Tray</option> <option value="Double Wall Tuck Front">Double Wall Tuck Front</option> <option value="Double Wall Tuck Top">Double Wall Tuck Top</option> <option value="Easel Counter Display">Easel Counter Display</option> <option value="Easel Display Stand">Easel Display Stand</option> <option value="Economy Disc Folder">Economy Disc Folder</option> <option value="Eyeliner Boxes">Eyeliner Boxes</option> <option value="Eyeshadow Boxes">Eyeshadow Boxes</option> <option value="Favor Boxes">Favor Boxes</option> <option value="Fence Partitions">Fence Partitions</option> <option value="Five Panel Hanger">Five Panel Hanger</option> <option value="Flip Out Open Dispenser Box">Flip Out Open Dispenser Box</option> <option value="Flower Shaped Top Closure">Flower Shaped Top Closure</option> <option value="Folder Business Card">Folder Business Card</option> <option value="Folders Printing">Folders Printing</option> <option value="Folding Boxes">Folding Boxes</option> <option value="Foot Lock Tray">Foot Lock Tray</option> <option value="Foundation Boxes">Foundation Boxes</option> <option value="Four Corner Cake Box">Four Corner Cake Box</option> <option value="Four Corner Tray">Four Corner Tray</option> <option value="Four Corner with Display Lid">Four Corner with Display Lid</option> <option value="Four Panel Cd Jacket">Four Panel Cd Jacket</option> <option value="French Fry Boxes">French Fry Boxes</option> <option value="Front Cut Out Display Tray">Front Cut Out Display Tray</option> <option value="Full Flap Auto Bottom">Full Flap Auto Bottom</option> <option value="Full Flat Double Tray">Full Flat Double Tray</option> <option value="Full Overlap Seal End">Full Overlap Seal End</option> <option value="Gable Bag">Gable Bag</option> <option value="Gable Bag Auto Bottom">Gable Bag Auto Bottom</option> <option value="Gable Bag Bottom Hanger">Gable Bag Bottom Hanger</option> <option value="Gable Box">Gable Box</option> <option value="Gable Box Auto Bottom">Gable Box Auto Bottom</option> <option value="Gable Boxes">Gable Boxes</option> <option value="Game Boxes">Game Boxes</option> <option value="Gift Card Boxes">Gift Card Boxes</option> <option value="Glass Carrier">Glass Carrier</option> <option value="Gold Foil Boxes">Gold Foil Boxes</option> <option value="Hair Extension Boxes">Hair Extension Boxes</option> <option value="Hairspray Boxes">Hairspray Boxes</option> <option value="Half Circular Interlocking">Half Circular Interlocking</option> <option value="Handle Bag Shape Box">Handle Bag Shape Box</option> <option value="Handle Boxes">Handle Boxes</option> <option value="Hanger Product Holder">Hanger Product Holder</option> <option value="Header Card">Header Card</option> <option value="Header Card Bag Topper">Header Card Bag Topper</option> <option value="Hexagon">Hexagon</option> <option value="Hexagon 2 PC">Hexagon 2 PC</option> <option value="Ice Cream Cone Holder">Ice Cream Cone Holder</option> <option value="Invitation Boxes">Invitation Boxes</option> <option value="Kraft Boxes">Kraft Boxes</option> <option value="Lip Balm Boxes">Lip Balm Boxes</option> <option value="Lip Gloss Boxes">Lip Gloss Boxes</option> <option value="Lipstick Boxes">Lipstick Boxes</option> <option value="Lotion Boxes">Lotion Boxes</option> <option value="Macaron Boxes">Macaron Boxes</option> <option value="Mailer With Zipper">Mailer With Zipper</option> <option value="Makeup Boxes">Makeup Boxes</option> <option value="Mascara Boxes">Mascara Boxes</option> <option value="Medicine Boxes">Medicine Boxes</option> <option value="Muffin Boxes">Muffin Boxes</option> <option value="Multi Purpose Header">Multi Purpose Header</option> <option value="Nail Polish Boxes">Nail Polish Boxes</option> <option value="Noodle Boxes">Noodle Boxes</option> <option value="Ornament Boxes">Ornament Boxes</option> <option value="Panel Hanger Snap Lock Bottom">Panel Hanger Snap Lock Bottom</option> <option value="Paper Boxes">Paper Boxes</option> <option value="Paper Brief Case">Paper Brief Case</option> <option value="Pastry Boxes">Pastry Boxes</option> <option value="Perforated Dispenser Box">Perforated Dispenser Box</option> <option value="Perfume Boxes">Perfume Boxes</option> <option value="Pie Boxes">Pie Boxes</option> <option value="Piece Tray With Reinforced Side Wall">Piece Tray With Reinforced Side Wall</option> <option value="Pillow Box">Pillow Box</option> <option value="Pillow Boxes">Pillow Boxes</option> <option value="Pinch Lock Tray">Pinch Lock Tray</option> <option value="Pizza Boxes">Pizza Boxes</option> <option value="Playing Card Boxes">Playing Card Boxes</option> <option value="Pop Counter Display Tray">Pop Counter Display Tray</option> <option value="Popcorn Boxes">Popcorn Boxes</option> <option value="Postage Boxes">Postage Boxes</option> <option value="Presentation Boxes">Presentation Boxes</option> <option value="Prism Shaped Box">Prism Shaped Box</option> <option value="Product Boxes">Product Boxes</option> <option value="Punch Partition">Punch Partition</option> <option value="Pyramid Boxes">Pyramid Boxes</option> <option value="Regular Six Corner">Regular Six Corner</option> <option value="Reinforced Sides With Hinged Top">Reinforced Sides With Hinged Top</option> <option value="Reverse Tuck End">Reverse Tuck End</option> <option value="Reverse Tuck End With Lock">Reverse Tuck End With Lock</option> <option value="Roll End Tray">Roll End Tray</option> <option value="Roll End Tuck Top">Roll End Tuck Top</option> <option value="Roll Ends With Lid">Roll Ends With Lid</option> <option value="Seal End">Seal End</option> <option value="Seal End Auto Bottom">Seal End Auto Bottom</option> <option value="Seal End With Perforated Top">Seal End With Perforated Top</option> <option value="Seal End With Tear Open">Seal End With Tear Open</option> <option value="Seal End With Tear Open and Lock">Seal End With Tear Open and Lock</option> <option value="Self Lock Cake Box">Self Lock Cake Box</option> <option value="Self-Locked Counter Display Tray">Self-Locked Counter Display Tray</option> <option value="Shirt Boxes">Shirt Boxes</option> <option value="Side Lock Six Corner">Side Lock Six Corner</option> <option value="Side Lock Tuck Top Display Box">Side Lock Tuck Top Display Box</option> <option value="Silver Foil Boxes">Silver Foil Boxes</option> <option value="Simplex Tray">Simplex Tray</option> <option value="Six Panel Cd Jacket">Six Panel Cd Jacket</option> <option value="Six Pk Bottle Carrier">Six Pk Bottle Carrier</option> <option value="Sleeve Boxes">Sleeve Boxes</option> <option value="Sleeve With Cap Lock">Sleeve With Cap Lock</option> <option value="Sleeve With Product Retainers">Sleeve With Product Retainers</option> <option value="Sleeve With Tapered Side Panel">Sleeve With Tapered Side Panel</option> <option value="Slope Top Reverse Tuck End">Slope Top Reverse Tuck End</option> <option value="Snack Boxes">Snack Boxes</option> <option value="Soap Boxes">Soap Boxes</option> <option value="Software Boxes">Software Boxes</option> <option value="Sports Boxes">Sports Boxes</option> <option value="Square Box With Ladder Top">Square Box With Ladder Top</option> <option value="Straight Tuck End">Straight Tuck End</option> <option value="Straight Tuck With Customizable Window">Straight Tuck With Customizable Window</option> <option value="Straight Tuck With Rise Up Insert">Straight Tuck With Rise Up Insert</option> <option value="Suitcase Boxes">Suitcase Boxes</option> <option value="T Box">T Box</option> <option value="Table Tents">Table Tents</option> <option value="Tags Printing">Tags Printing</option> <option value="Tea Boxes">Tea Boxes</option> <option value="Tie Boxes">Tie Boxes</option> <option value="Toy Boxes">Toy Boxes</option> <option value="Tray and sleeve Box">Tray and sleeve Box</option> <option value="Triangular Tray Lid">Triangular Tray Lid</option> <option value="Truffle Boxes">Truffle Boxes</option> <option value="Tuck End Auto Bottom">Tuck End Auto Bottom</option> <option value="Tuck End Cover">Tuck End Cover</option> <option value="Tuck End Snap Lock Bottom">Tuck End Snap Lock Bottom</option> <option value="Tuck With Bellow Dust Flap Lock">Tuck With Bellow Dust Flap Lock</option> <option value="Two Panel Cd Jacket">Two Panel Cd Jacket</option> <option value="Two Piece">Two Piece</option> <option value="Vinyl Banners">Vinyl Banners</option> <option value="Wedding Card Boxes">Wedding Card Boxes</option> <option value="White Boxes">White Boxes</option> <option value="Window Boxes">Window Boxes</option> <option value="Wine Bottle Carriers">Wine Bottle Carriers</option> <option value="Wine Boxes">Wine Boxes</option> <option value="Wrap Boxes">Wrap Boxes</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="country-select clearfix">
									<label>Stock <span class="required">*</span></label>
									<select name="stock" required class="nice-select wide">


										<option value="12pt Cardboard Stock">12pt Cardboard Stock</option> 

										<option value="14pt Cardboard Stock">14pt Cardboard Stock</option> 

										<option value="16pt Cardboard Stock">16pt Cardboard Stock</option> 

										<option value="18pt Cardboard Stock">18pt Cardboard Stock</option> 

										<option value="20pt Cardboard Stock">20pt Cardboard Stock</option> 

										<option value="22pt Cardboard Stock">22pt Cardboard Stock</option> 

										<option value="24pt Cardboard Stock">24pt Cardboard Stock</option> 

										<option value="Kraft Stock">Kraft Stock</option> 

										<option value="Recycled BuxBoard">Recycled BuxBoard</option> 

										<option value="Corrugated Stock">Corrugated Stock</option> 

										<option value="No Printing Required">No Printing Required</option> 
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="checkout-form-list">
									<H3>Size</h3>
									</div>
								</div>
								<div class="col-md-3">
									<div class="checkout-form-list mb-30">

										<input placeholder="Length" required type="text"  name="length">
									</div>
								</div>
								<div class="col-md-3">
									<div class="checkout-form-list mb-30">

										<input placeholder="Width" required type="text" name="width">
									</div>
								</div>
								<div class="col-md-3">
									<div class="checkout-form-list mb-30">
									<input placeholder="Height" required type="text" name="height">
									</div>
								</div>
								<div class="col-md-3">
									<div class="checkout-form-list mb-30">
										<select name="unit" required class="nice-select wide">
											<option value="Inches">Inches</option>
											<option value="cm">cm</option>
											<option value="mm">mm</option>
										</select>
									</div>
								</div>




								<div class="col-md-6">
									<div class="checkout-form-list">
										<input placeholder="Qty1" type="text" name="qty1">
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<input placeholder="Qty2" type="text" name="qty2">
									</div>
								</div>


								<div class="col-md-6">
									<div class="country-select clearfix">
										<label>Color <span class="required">*</span></label>
										<select name="colors" class="nice-select wide">
											<option value="None">None</option>
											<option value="1 Colour">1 Colour</option>
											<option value="2 Colour">2 Colour</option>
											<option value="3 Colour">3 Colour</option>
											<option value="4 Colour">4 Colour</option>
											<option value="4/1 Colour">4/1 Colour</option>
											<option value="4/2 Colour">4/2 Colour</option>
											<option value="4/3 Colour">4/3 Colour</option>
											<option value="4/4 Colour">4/4 Colour</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="country-select clearfix">
										<label>Type <span class="required">*</span></label>
										<select name="purpose" required class="nice-select wide">
											<option value="Request for Quote">Get Quote</option>
											<option value="Request for Template">Get Template</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class=" clearfix">
										<label>Comment <span class="required">*</span></label>
										<textarea name="comments"  required row="5" class="comment-rfq"></textarea>
									</div>
								</div>

								<div class="col-md-12">
									<br><br>
									<input type="submit" name="submit" value="Request Quote" class="fb-btn  request-for-quote-btn">
								</div>



							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection