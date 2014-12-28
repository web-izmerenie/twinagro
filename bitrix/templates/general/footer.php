
		</div>
	</section>

	<footer>
		<hr />
		<div id="author">
			<span class="ico-author sprite-ico"></span>
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath(
					"include_areas/".LANGUAGE_ID."/copyright.php"),
					Array(),
					Array("MODE" => "php"));?>
		</div>
	</footer>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter27005949 = new Ya.Metrika({id:27005949,
						webvisor:true,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="//mc.yandex.ru/watch/27005949" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</body>
</html>
