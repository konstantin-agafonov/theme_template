class Fetch {
  url = '/?wc-ajax=';

  defaultParams = {
    // по-умолчанию body в формате default
    headers: {
      'Content-Type': 'application/json',
    },
    cache: 'force-cache',
    credentials: 'same-origin',
    referrerPolicy: 'same-origin',
  };

  doFetch = async ({
    url, method, body, nonce, action,
  }) => {
    if (url && action) {
      // или url или action
      return;
    }
    if (!url) {
      url = `${this.url}${action}`;
    }
    if (!method) {
      method = 'GET';
    }
    if (nonce) {
      body.nonce = nonce;
    }

    let fetchResponse;
    let responseData;
    try {
      fetchResponse = await fetch(url, {
        method,
        body: JSON.stringify(body),
        ...this.defaultParams,
      });
      responseData = await fetchResponse.json();
    } catch (err) {
      console.log(err);
      return false;
    }
    return responseData;
  };
}

export { Fetch };
