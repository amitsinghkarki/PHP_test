const test = ["frizz", "zane", "Zazz"];
const test1 = test.map(
    (a) => (a.match(/[za]/gi) || []).length
);
console.log(test1);