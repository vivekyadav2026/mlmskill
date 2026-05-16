@extends('layouts.admin')
@section('content')
<style>
  #tree-viewport{width:100%;overflow:hidden;position:relative;background:#0b1220;border-radius:10px;border:1px solid #334155;height:75vh;min-height:450px;cursor:grab;user-select:none}
  #tree-viewport.panning{cursor:grabbing}
  #tree-canvas{position:absolute;transform-origin:0 0;display:inline-flex;flex-direction:column;align-items:center;padding:40px}
  .tree-node{display:inline-flex;flex-direction:column;align-items:center;position:relative;padding:0 16px}
  .tree-children{display:flex;justify-content:center;padding-top:20px;position:relative}
  .tree-children::before{content:'';position:absolute;top:0;left:50%;border-left:2px solid #475569;height:20px}
  .tree-children .tree-node::before{content:'';position:absolute;top:-20px;left:50%;border-left:2px solid #475569;height:20px}
  .tree-children .tree-node::after{content:'';position:absolute;top:-20px;left:0;right:50%;border-top:2px solid #475569;height:0}
  .tree-children .tree-node:first-child::after{display:none}
  .node-card{display:flex;flex-direction:column;align-items:center;cursor:pointer;background:#1a222d;border:2px solid #334155;border-radius:10px;padding:10px 14px;min-width:115px;transition:border-color .2s,box-shadow .2s}
  .node-card:hover{border-color:#6366f1;box-shadow:0 0 12px rgba(99,102,241,.3)}
  .node-card.selected{border-color:#6366f1;background:#1e2a3a}
  .node-card.root-all{border-color:#6366f1;background:#1e1a3a;cursor:default}
  .node-avatar{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;color:#fff}
  .node-name{font-size:.75rem;font-weight:600;color:#e2e8f0;margin-top:6px;text-align:center;max-width:105px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .node-code{font-size:.65rem;color:#94a3b8;font-family:monospace;margin-top:2px}
  .node-badge{font-size:.6rem;margin-top:4px;padding:1px 6px;border-radius:9999px;font-weight:600}
  .node-badge.active{background:#14532d;color:#86efac}
  .node-badge.inactive{background:#450a0a;color:#fca5a5}
  .node-count{font-size:.6rem;color:#6366f1;margin-top:4px}
  .node-actions{display:flex;gap:4px;margin-top:6px}
  .node-actions a{font-size:.6rem;padding:2px 8px;border-radius:6px;background:#1e293b;border:1px solid #334155;color:#94a3b8;text-decoration:none}
  .node-actions a:hover{color:#e2e8f0;border-color:#6366f1}
  .zoom-controls{position:absolute;bottom:16px;right:16px;z-index:20;display:flex;flex-direction:column;gap:4px;align-items:center}
  .zoom-btn{width:36px;height:36px;border-radius:8px;background:#1a222d;border:1px solid #334155;color:#e2e8f0;font-size:1.1rem;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s}
  .zoom-btn:hover{background:#6366f1;border-color:#6366f1}
  .zoom-pct{font-size:.7rem;color:#94a3b8;text-align:center}
  #breadcrumb{display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:10px}
  .bc-item{font-size:.8rem;color:#6366f1;cursor:pointer;text-decoration:underline}
  .bc-sep{color:#475569;font-size:.8rem}
  .bc-item.current{color:#e2e8f0;text-decoration:none;cursor:default}
  #tree-loader{text-align:center;padding:40px;color:#94a3b8;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)}
</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
  <div class="mb-4 flex flex-wrap items-center gap-3">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Genealogy Tree</h2>
      <p class="text-gray-400 text-sm">Scroll to zoom &middot; Drag to pan &middot; Click a member to drill down</p>
    </div>
    <div class="ml-auto flex gap-2">
      <button id="fitBtn" class="px-3 py-1.5 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm"><i class="fa-solid fa-expand mr-1"></i>Fit All</button>
      <button id="resetTreeBtn" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-sm hidden"><i class="fa-solid fa-rotate-left mr-1"></i>Root</button>
    </div>
  </div>
  <div id="breadcrumb"></div>
  <div id="tree-viewport">
    <div id="tree-loader"><i class="fa-solid fa-spinner fa-spin fa-2x"></i><br><span class="text-sm mt-2 block">Loading...</span></div>
    <div id="tree-canvas"></div>
    <div class="zoom-controls">
      <button class="zoom-btn" id="zoomInBtn"><i class="fa-solid fa-plus"></i></button>
      <button class="zoom-btn" id="zoomOutBtn"><i class="fa-solid fa-minus"></i></button>
      <button class="zoom-btn" id="zoomResetBtn"><i class="fa-solid fa-arrows-to-dot"></i></button>
      <div class="zoom-pct" id="zoomPct">100%</div>
    </div>
  </div>
</div>
<script>
let historyStack=[],scale=1,panX=0,panY=0,isPanning=false,startX=0,startY=0,startPX=0,startPY=0;
const vp=document.getElementById('tree-viewport'),canvas=document.getElementById('tree-canvas');
function applyT(){canvas.style.transform=`translate(${panX}px,${panY}px) scale(${scale})`;document.getElementById('zoomPct').textContent=Math.round(scale*100)+'%';}
function setZoom(ns,cx,cy){const r=vp.getBoundingClientRect();cx=cx??r.width/2;cy=cy??r.height/2;const ratio=ns/scale;panX=cx-ratio*(cx-panX);panY=cy-ratio*(cy-panY);scale=Math.min(3,Math.max(0.05,ns));applyT();}
function fitAll(){requestAnimationFrame(()=>{const cw=canvas.scrollWidth,ch=canvas.scrollHeight,vw=vp.clientWidth,vh=vp.clientHeight;scale=Math.min(vw/cw,vh/ch,1)*0.92;panX=(vw-cw*scale)/2;panY=20;applyT();});}
document.getElementById('zoomInBtn').addEventListener('click',()=>setZoom(scale*1.2));
document.getElementById('zoomOutBtn').addEventListener('click',()=>setZoom(scale/1.2));
document.getElementById('zoomResetBtn').addEventListener('click',fitAll);
document.getElementById('fitBtn').addEventListener('click',fitAll);
vp.addEventListener('wheel',e=>{e.preventDefault();const r=vp.getBoundingClientRect();setZoom(scale*(e.deltaY<0?1.12:1/1.12),e.clientX-r.left,e.clientY-r.top);},{passive:false});
vp.addEventListener('mousedown',e=>{if(e.button!==0)return;isPanning=true;startX=e.clientX;startY=e.clientY;startPX=panX;startPY=panY;vp.classList.add('panning');});
window.addEventListener('mousemove',e=>{if(!isPanning)return;panX=startPX+(e.clientX-startX);panY=startPY+(e.clientY-startY);applyT();});
window.addEventListener('mouseup',()=>{isPanning=false;vp.classList.remove('panning');});
function buildNode(node,isRoot){
  const w=document.createElement('div');w.className='tree-node';
  const isVR=node.id===0;
  const c=document.createElement('div');c.className='node-card'+(isRoot?' selected':'')+(isVR?' root-all':'');
  const bg=isVR?'#4338ca':(node.status==='active'?'#166534':'#7f1d1d');
  const init=isVR?'★':node.name.charAt(0).toUpperCase();
  let acts='';
  if(!isVR)acts=`<div class="node-actions"><a href="/admin/users/${node.id}" onclick="event.stopPropagation()" title="View"><i class="fa-solid fa-eye"></i></a><a href="/admin/users/${node.id}/edit" onclick="event.stopPropagation()" title="Edit"><i class="fa-solid fa-pen"></i></a></div>`;
  c.innerHTML=`<div class="node-avatar" style="background:${bg}">${init}</div><div class="node-name">${node.name}</div>${node.referral_code?`<div class="node-code">${node.referral_code}</div>`:''}<span class="node-badge ${node.status}">${node.status==='active'?'Active':'Inactive'}</span>${node.children&&node.children.length?`<span class="node-count"><i class="fa-solid fa-users mr-1"></i>${node.children.length}</span>`:''}${acts}`;
  if(!isVR){c.addEventListener('mousedown',e=>e.stopPropagation());c.addEventListener('click',()=>drillDown(node));}
  w.appendChild(c);
  if(node.children&&node.children.length){const ch=document.createElement('div');ch.className='tree-children';node.children.forEach(n=>ch.appendChild(buildNode(n,false)));w.appendChild(ch);}
  return w;
}
function renderTree(data){document.getElementById('tree-loader').style.display='none';canvas.innerHTML='';canvas.appendChild(buildNode(data,true));renderBC();fitAll();}
function drillDown(node){historyStack.push({id:node.id,name:node.name});loadNode(node.id);document.getElementById('resetTreeBtn').classList.remove('hidden');}
function loadNode(id){document.getElementById('tree-loader').style.display='block';canvas.innerHTML='';scale=1;panX=0;panY=0;applyT();fetch(`/admin/users/tree/node/${id}`).then(r=>r.json()).then(renderTree).catch(()=>{document.getElementById('tree-loader').innerHTML='<span style="color:#f87171">Failed to load.</span>';});}
function renderBC(){const bc=document.getElementById('breadcrumb');bc.innerHTML='';const re=document.createElement('span');re.className='bc-item'+(historyStack.length===0?' current':'');re.textContent='All Members';if(historyStack.length>0)re.addEventListener('click',()=>{historyStack=[];loadNode(0);document.getElementById('resetTreeBtn').classList.add('hidden');});bc.appendChild(re);historyStack.forEach((item,idx)=>{const s=document.createElement('span');s.className='bc-sep';s.textContent='›';bc.appendChild(s);const el=document.createElement('span');el.className='bc-item'+(idx===historyStack.length-1?' current':'');el.textContent=item.name;if(idx<historyStack.length-1)el.addEventListener('click',()=>{historyStack=historyStack.slice(0,idx+1);loadNode(item.id);});bc.appendChild(el);});}
document.getElementById('resetTreeBtn').addEventListener('click',()=>{historyStack=[];loadNode(0);document.getElementById('resetTreeBtn').classList.add('hidden');});
loadNode(0);
</script>
@endsection