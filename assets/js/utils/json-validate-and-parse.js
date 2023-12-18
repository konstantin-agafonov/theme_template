function jsonValidateAndParse(str) {
  let parse_result;
  try {
    parse_result = JSON.parse(str);
  } catch (e) {
    return false;
  }
  return parse_result;
}

export { jsonValidateAndParse };
