import { url } from './data';

export default async(result) => {
  console.log(result);
  const res = await fetch(`${url}/wp-json/lasaphire/v1/getproduct/`, {
    method: "GET",
    data: {
      nonce: sHelperData.sec,
    },
  });
  const data = res.json();

  if (res.ok) {
    return data;
  } else {
    throw new Error(data);
  }
};
