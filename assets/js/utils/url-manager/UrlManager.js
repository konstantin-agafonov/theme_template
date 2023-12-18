class UrlManager {
  setUrlParams = (params) => {
    const searchParams = new URLSearchParams(window.location.search);
    params.forEach(({ param, value }) => {
      searchParams.set(param, value);
    });
    this.applyParamsToUrl(searchParams);
  };

  setUrlParam = ({ param, value }) => {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set(param, value);
    this.applyParamsToUrl(searchParams);
  };

  removeUrlParam = (param) => {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.delete(param);
    this.applyParamsToUrl(searchParams);
  };

  applyParamsToUrl = (searchParams) => {
    const newRelativePathQuery = `${window.location.pathname}?${searchParams.toString()}`;
    history.pushState(null, '', newRelativePathQuery);
  };

  getUrlParam = (param) => {
    const searchParams = new URLSearchParams(window.location.search);
    return searchParams.get(param);
  };
}

export { UrlManager };
