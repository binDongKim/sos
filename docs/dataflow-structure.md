# SOS 데이터흐름 구조도

1. API에서 데이터받아옴: **api_** **get_***
2. wp*_*option에 저장함: **set_**
3. 실제로 페이지에 보여줄땐: **get_***
  * 3-1: data = get_option;
  * 3-2: if( data is old ) { a;b; }
  * 3-3: return data;
