$(document).ready(function(){

  var map = new naver.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: new naver.maps.LatLng(37.504014, 127.021745),
      scaleControl: false,
      logoControl: false,
      mapDataControl: false,
      zoomControl: true,
      minZoom: 1
  });

  var latlngs = [
      new naver.maps.LatLng(37.504014, 127.021745),
      new naver.maps.LatLng(37.501613, 127.043476),
      new naver.maps.LatLng(37.489014, 127.031975),
      new naver.maps.LatLng(37.512717, 127.023557),
      new naver.maps.LatLng(37.489241, 127.011576),
      new naver.maps.LatLng(37.495998, 126.988697),
      new naver.maps.LatLng(37.513633, 127.048891),
      new naver.maps.LatLng(37.530119, 127.034672),
      new naver.maps.LatLng(37.481847, 127.041100),
      new naver.maps.LatLng(37.490377, 127.010950)
  ];

  var markerList = [];

  for (var i=0, ii=latlngs.length; i<ii; i++) {
      var icon = {
              url: '../img/map/sp_pins_spot_v3.png',
              size: new naver.maps.Size(24, 37),
              anchor: new naver.maps.Point(12, 37),
              origin: new naver.maps.Point(i * 29, 0)
          },
          marker = new naver.maps.Marker({
              position: latlngs[i],
              map: map,
              icon: icon,
              shadow: {
                  url: '../img/map/shadow-pin_default.png',
                  size: new naver.maps.Size(40, 35),
                  origin: new naver.maps.Point(0, 0),
                  anchor: new naver.maps.Point(11, 35)
              }
          });

      marker.set('seq', i);

      markerList.push(marker);

      contentString = [
            '<div class="iw_inner">',
            '   <h3 class="js">도미노피자</h3>',
            '   <p>서울특별시 강남구 역삼로 146 청오빌딩<br>지번주소 서울특별시 강남구 역삼동 789<br />',
            '   02-1577-3082<br />',
            '       <a href="http://www.dominos.co.kr" target="_blank">www.dominos.co.kr/</a>',
            '   </p>',
            '</div>'
        ].join('');

      var infowindow = new naver.maps.InfoWindow({
          content : contentString,
          maxWidth: 300,
          backgroundColor: "#eee",
          anchorSize: new naver.maps.Size(30, 30),
          anchorSkew: true,
          anchorColor: "#eee",
          pixelOffset: new naver.maps.Point(20, -20)
      });


      marker.addListener('mouseover', onMouseOver);
      marker.addListener('mouseout', onMouseOut);
      marker.addListener('click', function(markerList){
        if (infowindow.getMap()){
           infowindow.close();
        } else {
            infowindow.open(map, markerList[0]);
        }
      });

      icon = null;
      marker = null;
  }

  infowindow.open(map, markerList[0]);

  function onMouseOver(e) {
      var marker = e.overlay,
          seq = marker.get('seq');

      marker.setIcon({
          url: '../img/map/sp_pins_spot_v3_over.png',
          size: new naver.maps.Size(24, 37),
          anchor: new naver.maps.Point(12, 37),
          origin: new naver.maps.Point(seq * 29, 50)
      });
  }

  function onMouseOut(e) {
      var marker = e.overlay,
          seq = marker.get('seq');

      marker.setIcon({
          url: '../img/map/sp_pins_spot_v3.png',
          size: new naver.maps.Size(24, 37),
          anchor: new naver.maps.Point(12, 37),
          origin: new naver.maps.Point(seq * 29, 0)
      });
  }


})
