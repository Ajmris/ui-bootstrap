$(function(){
  $('div.products-count a').click(function(/*event*/){
    //event.preventDefault();
    $('a.products-actual-count').text($(this).text());
    getProducts($(this).text());
  });

  $('button#filter-button').click(function(){
    getProducts($('a.products-actual-count').text());
  });

  // Nowa funkcja do pobierania numeru strony
  function getCurrentPage() {
      const params = new URLSearchParams(window.location.search);
      return params.get('page') || 1; // Zwraca 'page' z URL-a lub 1
  }

  function getProducts(paginate, page=1){
    const form = $('form.sidebar-filter').serialize();
    // 🌟 Pobieramy wszystkie parametry z URL-a (w tym 'page' i ewentualnie 'filter')
    const urlParams = new URLSearchParams(window.location.search);
    let dataToSend = form;
    
    // Dodajemy 'paginate'
    dataToSend += "&" + $.param({paginate: paginate});
    
    $.ajax({
      method: "GET",
      url: "/",
      data: form + "&" + $.param({paginate: paginate}),
    })
    .done(function(response){
      const wrapper = $('div#products-wrapper');
      wrapper.empty();

      $.each(response.data, function(index, product){
        const html = `
          <div class="col-md-3">
            <div class="product-card">
              <img src="${getImage(product)}" alt="${product.name}">
              <div class="product-info">
                <h6>${product.name}</h6>
                <p>${parseFloat(product.price).toFixed(2)} zł</p>
              </div>
            </div>
          </div>`;
        wrapper.append(html);
      });

      // 🟣 aktualizacja paginacji:
      if (response.pagination && response.pagination.links) {
        $('div.pagination-wrapper').html(response.pagination.links);
      }
    })
    .fail(function(){
      alert("Błąd podczas pobierania produktów");
    });
  }

  function getImage(product){
    return product.image_path ? storagePath + product.image_path : defaultImage;
  }
});