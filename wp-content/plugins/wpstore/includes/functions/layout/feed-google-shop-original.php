<?xml version="1.0"?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
	<channel>
		<title>Example - Online Store</title>
		<link>http://www.example.com</link>
		<description>This is a sample feed containing the required and recommended attributes for a variety of different products</description>
		
		<!-- First example shows what attributes are required and recommended for items that are not in the apparel category -->
		<item>
			<!-- The following attributes are always required -->
			<title>LG Flatron M2262D 22" Full HD LCD TV</title>
			<link>http://www.example.com/electronics/tv/LGM2262D.html</link>
			<description>Attractively styled and boasting stunning picture quality, the LG Flatron M2262D 22&quot; Full HD LCD TV is an excellent television/monitor. The LG Flatron M2262D 22&quot; Full HD LCD TV sports a widescreen 1080p panel, perfect for watching movies in their original format, whilst also providing plenty of working space for your other applications. You&#39;ll also experience an excellent sound quality with SRS TruSurround HD technology and built-in stereo speakers. Enjoy a broad range of free-to-air digital television channels and digital radio stations on the LG Flatron M2262D thanks to its built-in DVB-T Freeview tuner. Hook up the LG Flatron M2262D 22&quot; Full HD LCD TV to most external devices with ease, thanks to its comprehensive range of ports including 2 HDMI ports, 2 SCART sockets, a DVI connector, a VGA connector and USB connectivity - allowing you to input your own multimedia files.</description>
			<g:id>TV_123456</g:id>
			<g:condition>used</g:condition>
			<g:price>159.00 USD</g:price>
			<g:availability>in stock</g:availability>
			<g:image_link>http://images.example.com/TV_123456.png</g:image_link>
			<g:shipping>
				<g:country>US</g:country>
				<g:service>Standard</g:service>
				<g:price>14.95 USD</g:price>
			</g:shipping>
			
			<!-- The following attributes are required because this item is not apparel or a custom good -->
			<g:gtin>8808992787426</g:gtin>
			<g:brand>LG</g:brand>
			<g:mpn>M2262D-PC</g:mpn>
			
			<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
			<g:product_type>Consumer Electronics &gt; TVs &gt; Flat Panel TVs</g:product_type>
		</item>
		
		<!-- Second example demonstrates the use of CDATA sections instead of entities to deal with special characters. Note that CDATA sections can be used for any attribute -->
		<item>
			<!-- The following attributes are always required -->
			<title><![CDATA[Merlin: Series 3 - Volume 2 - 3 DVD Box set]]></title>
			<link><![CDATA[http://www.example.com/media/dvd/?sku=384616&src=gshopping&lang=en]]></link>
			<description><![CDATA[Episodes 7-13 from the third series of the BBC fantasy drama set in the mythical city of Camelot, telling the tale of the relationship between the young King Arthur (Bradley James) & Merlin (Colin Morgan), the wise sorcerer who guides him to power and beyond. Episodes are: 'The Castle of Fyrien', 'The Eye of the Phoenix', 'Love in the Time of Dragons', 'Queen of Hearts', 'The Sorcerer's Shadow', 'The Coming of Arthur: Part 1' & 'The Coming of Arthur: Part 2']]></description>
			<g:id>DVD-0564738</g:id>
			<g:condition>new</g:condition>
			<g:price>11.99 USD</g:price>
			<g:availability>preorder</g:availability>
			<g:image_link><![CDATA[http://images.example.com/DVD-0564738?size=large&format=PNG]]></g:image_link>
			<g:shipping>
				<g:country>US</g:country>
				<g:service>Express Mail</g:service>
				<g:price>3.80 USD</g:price>
			</g:shipping>
			
			<!-- The following attributes are required because this item is not apparel or a custom good -->
			<g:gtin>5030697019233</g:gtin>
			<g:brand>BBC</g:brand>
			
			<!-- The following attribute is required because this item is in the 'Media' category -->
			<g:google_product_category><![CDATA[Media > DVDs & Movies > Television Shows]]></g:google_product_category>
			
			<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
			<g:product_type><![CDATA[DVDs & Movies > TV Series > Fantasy Drama]]></g:product_type>
		</item>
		
		<!-- Third example shows how to include multiple images and shipping values -->
		<item>
			<!-- The following attributes are always required -->
			<title>Dior Capture R60/80 XP Restoring Wrinkle Creme Rich Texture 30ml</title>
			<link>http://www.example.com/perfumes/product?Dior%20Capture%20R6080%20XP</link>
			<description>Dior Capture R60/80 XP Ultimate Wrinkle Creme reinvents anti-wrinkle care by protecting and relaunching skin cell activity to encourage faster, healthier regeneration.</description>
			<g:id>PFM654321</g:id>
			<g:condition>new</g:condition>
			<g:price>46.75 USD</g:price>
			<g:availability>in stock</g:availability>
			<g:image_link>http://images.example.com/PFM654321_1.jpg</g:image_link>
			<g:shipping>
				<g:country>US</g:country>
				<g:service>Standard Rate</g:service>
				<g:price>4.95 USD</g:price>
			</g:shipping>
			<g:shipping>
				<g:country>US</g:country>
				<g:service>Next Day</g:service>
				<g:price>8.50 USD</g:price>
			</g:shipping>
			
			<!-- The following attributes are required because this item is not apparel or a custom good -->
			<g:gtin>3348900839731</g:gtin>
			<g:brand>Dior</g:brand>
			
			<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
			<g:product_type>Health &amp; Beauty &gt; Personal Care &gt; Cosmetics &gt; Skin Care &gt; Lotion</g:product_type>
			<g:additional_image_link>http://images.example.com/PFM654321_2.jpg</g:additional_image_link>
			<g:additional_image_link>http://images.example.com/PFM654321_3.jpg</g:additional_image_link>
		</item>
		
		<!-- Fourth example shows what attributes are required and recommended for items that are in the apparel category -->
		<item>
			<!-- The following attributes are always required -->
			<title>Roma Cotton Rich Bootcut Jeans with Belt - Size 8 Standard</title>
			<link>http://www.example.com/clothing/women/Roma-Cotton-Bootcut-Jeans/?extid=CLO-29473856</link>
			<description>Comes with the belt. A smart pair of bootcut jeans in stretch cotton. The flower print buckle belt makes it extra stylish.</description>
			<g:id>CLO-29473856-1</g:id>
			<g:condition>new</g:condition>
			<g:price>29.50 USD</g:price>
			<g:availability>out of stock</g:availability>	
			<g:image_link>http://images.example.com/CLO-29473856-front.jpg</g:image_link>
			
			<g:shipping_weight>750 g</g:shipping_weight> <!-- For use in combination with the account level shipping setting -->
		
			<!-- The following attributes are required because this item is apparel -->
			<g:google_product_category>Apparel &amp; Accessories &gt; Clothing &gt; Jeans</g:google_product_category>
			<g:gender>Female</g:gender>
			<g:age_group>Adult</g:age_group>
			<g:color>Navy</g:color>
			<g:size>8 Standard</g:size>
			
			<!-- The following attribute is required because this item has variants -->
			<g:item_group_id>CLO-29473856</g:item_group_id>
			
			<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
			<g:brand>M&amp;S</g:brand>
			<g:mpn>B003J5F5EY</g:mpn>
			<g:product_type>Women's Clothing &gt; Jeans &gt; Bootcut Jeans</g:product_type>
			<g:additional_image_link>http://images.example.com/CLO-29473856-side.jpg</g:additional_image_link>
			<g:additional_image_link>http://images.example.com/CLO-29473856-back.jpg</g:additional_image_link>
		</item>
		
		<!-- This is a variant of the last item (same 'item group id'). In this case the variant is only by size, but the item could be repeated in the same way for other variants -->
		<item>
			<!-- The following attributes are always required -->
			<title>Roma Cotton Rich Bootcut Jeans with Belt - Size 8 Tall</title>
			<link>http://www.example.com/clothing/women/Roma-Cotton-Bootcut-Jeans/?extid=CLO-29473856</link>
			<description>Comes with the belt. A smart pair of bootcut jeans in stretch cotton. The flower print buckle belt makes it extra stylish.</description>
			<g:id>CLO-29473856-2</g:id>
			<g:condition>new</g:condition>
			<g:price>29.50 USD</g:price>
			<g:availability>in stock</g:availability>	
			<g:image_link>http://images.example.com/CLO-29473856-front.jpg</g:image_link>
			
			<g:shipping_weight>820 g</g:shipping_weight> <!-- For use in combination with the account level weight based shipping setting -->
		
			<!-- The following attributes are required because this item is apparel -->
			<g:google_product_category>Apparel &amp; Accessories &gt; Clothing &gt; Jeans</g:google_product_category>
			<g:gender>Female</g:gender>
			<g:age_group>Adult</g:age_group>
			<g:color>Navy</g:color>
			<g:size>8 Tall</g:size>
			
			<!-- The following attribute is required because this item has variants -->
			<g:item_group_id>CLO-29473856</g:item_group_id>
			
			<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
			<g:brand>M&amp;S</g:brand>
			<g:mpn>B003J5F5EY</g:mpn>
			<g:product_type>Women's Clothing &gt; Jeans &gt; Bootcut Jeans</g:product_type>
			<g:additional_image_link>http://images.example.com/CLO-29473856-side.jpg</g:additional_image_link>
			<g:additional_image_link>http://images.example.com/CLO-29473856-back.jpg</g:additional_image_link>
		</item>
		
		<!-- Fifth example demonstrates the use of the sale price attributes  -->
		<item>
			<!-- The following attributes are always required -->
			<title>Tenn Cool Flow Ladies Long Sleeved Cycle Jersey</title>
			<link>http://www.example.com/clothing/sports/product?id=CLO1029384&amp;src=gshopping&amp;popup=false</link>
			<description>A ladies' cycling jersey designed for the serious cyclist, tailored to fit a feminine frame. This sporty, vibrant red, black and white jersey is constructed of a special polyester weave that is extremely effective at drawing moisture away from your body, helping to keep you dry.  With an elasticised, gripping waist, it will stay in place for the duration of your cycle, and won't creep up like many other products. It has two elasticised rear pockets and the sleeves are elasticated to prevent creep-up.</description>
			<g:id>CLO-1029384</g:id>
			<g:condition>new</g:condition>
			<g:price>33.99 USD</g:price>
			<g:availability>available for order</g:availability>
			<g:image_link>http://images.example.com/CLO-1029384.jpg</g:image_link>
			<g:shipping>
				<g:country>US</g:country>
				<g:service>Standard Free Shipping</g:service>
				<g:price>0 USD</g:price>
			</g:shipping>
			
			<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
			<g:gtin>5060155240282</g:gtin>
			<g:product_type>Sporting Goods &gt; Outdoor Recreation &gt; Cycling &gt; Bicycle Clothing &gt; Bicycle Jerseys</g:product_type>
			<g:gender>Female</g:gender>
			<g:age_group>Adult</g:age_group>
			<g:color>Black/Red/White</g:color> <!-- Indicates all the colours found on the garment in order of dominance -->
			<g:size>M</g:size>
			
			<!-- The following demonstrate the use of the 'sale price' and 'sale price effective date' and attributes -->
			<g:sale_price>25.49 USD</g:sale_price>
			<g:sale_price_effective_date>2011-09-01T16:00-08:00/2011-09-03T16:00-08:00</g:sale_price_effective_date>
		</item>
	</channel>
</rss>